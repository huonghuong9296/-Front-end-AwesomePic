<?php
require('config.php');
class Data extends Dbconfig {	
    protected $hostName;
    protected $userName;
    protected $password;
	protected $dbName;
	private $dbTable = 'order_detail';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 		
			$database = new dbConfig();            
            $this -> hostName = $database -> serverName;
            $this -> userName = $database -> userName;
            $this -> password = $database ->password;
			$this -> dbName = $database -> dbName;			
            $conn = new mysqli($this->hostName, $this->userName, $this->password, $this->dbName);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
			}
			else{
				$this->dbConnect = $conn;
				$this->dbConnect->autocommit(false);
			}
        }
    }
	private function getData($query) {
		$result = mysqli_query($this->dbConnect, $query);
		if(!$result){
			die('Error in query: '. mysqli_error($result));
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($query) {
		$result = mysqli_query($this->dbConnect, $query);
		if(!$result){
			die('Error in query: '. mysqli_error($result));
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}

	public function dataList(){		
		
		$query = "SELECT		a.order_id			order_id,
								c.username			username,
								a.product_id		product_id,
								d.NAME				product_name,
								a.total_price		total_price,
								a.quantity			quantity,
								a.price				price
					FROM		".$this->dbTable."	a,
								orders				b,
								users				c,
								products			d 		
					WHERE 		a.order_id	 	= b.id
					AND			a.product_id	= d.id
					AND			b.user_id		= c.id
					";
		if(!empty($_POST["search"]["value"])){
			$query .= ' AND (a.order_id LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR c.username LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR a.product_id LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR d.NAME LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR a.total_price LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR a.price LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR a.quantity LIKE "%'.$_POST["search"]["value"].'%") ';			
		}
		
		$colArr = ['order_id', 'order_id', 'username', 'product_id', 'product_name', 'total_price', 'quantity', 'price'];
		if(!empty($_POST["order"])){
			$query .= 'ORDER BY '.$colArr[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
		}
		else {
			$query .= 'ORDER BY order_id DESC ';
		}
		if($_POST["length"] != -1){
			$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $query);
		if (!$result) {
			$error = " Error select order detail search: ".$this->dbConnect->error;
			echo json_encode($error);
		}
		
		$query1 = "SELECT * FROM ".$this->dbTable." WHERE 1 ";
		$result1 = mysqli_query($this->dbConnect, $query1);
		if (!$result1) {
			$error = " Error select order detail numRows: ".$this->dbConnect->error;
			echo json_encode($error);
		}

		$numRows = mysqli_num_rows($result1);
		
		$dataTable = array();	
		while( $data = mysqli_fetch_assoc($result) ) {		
			$dataRows = array();			
			$dataRows[] = '<a class="btn btn-sm btn-info edt-btn-admin"><i class="fa fa-edit"></i></a>
						   <a class="btn btn-sm btn-danger del-btn-admin"><i class="fa fa-trash"></i></a>';
			$dataRows[] = $data['order_id'];
			$dataRows[] = $data['username'];
			$dataRows[] = $data['product_id'];
			$dataRows[] = $data['product_name'];
			$dataRows[] = $data['total_price'];
			$dataRows[] = $data['quantity'];
			$dataRows[] = $data['price'];
			$dataTable[] = $dataRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$dataTable
		);
		echo json_encode($output);
	}

	public function addData(){
		$error = array(
			'error' 			=> 'success',
			'queryErr'			=> '',
			'order_idErr'		=> '',
			'product_idErr'		=> '',
			'priceErr'			=> '',
			'quantityErr'		=> ''
		);

		$order_id 		= $_POST['order_id'];
		$product_id 	= $_POST['product_id'];
		$price 			= $_POST['price'];
		$quantity 		= $_POST['quantity'];

		if (empty($order_id) || trim($order_id) == "") {
			$error['order_idErr'] = "* Order ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $order_id)) {
			$error['order_idErr'] = "* Invalid order ID format!";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	orders
							WHERE 	id   		= '$order_id'
							AND  	is_deleted 	= '0'";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] == 0) {
					$error['order_idErr'] = "* Order ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist order ID: ".$this->dbConnect->error;
			}
		}

		if (empty($product_id) || trim($product_id) == "") {
			$error['product_idErr'] = "* Product ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $product_id)) {
			$error['product_idErr'] = "* Invalid Product ID format!";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	products
							WHERE 	id   		= '$product_id'
							AND  	is_deleted 	= '0'";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] == 0) {
					$error['product_idErr'] = "* Product ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist Product ID: ".$this->dbConnect->error;
			}
		}

		if (empty($price) || trim($price) == "") {
			$error['priceErr'] = "* Price is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[-+]?[0-9]+\.[0-9]+$/",$price)) {
			$error['priceErr'] = "* Invalid price format! Input values ​​are accurate to 1-2 decimal places.";
			$error['error'] = "error";
		}
		else if ($price >= 10000000000000) {
			$error['priceErr'] = " Invalid price format! Limited to 13 whole digits.";
			$error['error'] = "error";
		}

		if (empty($quantity) || trim($quantity) == "") {
			$error['quantityErr'] = "* Quantity is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $quantity) || $quantity < 0) {
			$error['quantityErr'] = "* Invalid quantity format!";
			$error['error'] = "error";
		}
		else if ($quantity > 2000000000) {
			$error['quantityErr'] = "* Invalid quantity format! Limited to 2,000,000,000";
			$error['error'] = "error";
		}

		$query_check =  "SELECT count(1) 
						FROM 	".$this->dbTable."
						WHERE 	product_id   	= '$product_id'
						AND  	order_id  		= '$order_id'";
		$query_check_run = mysqli_query($this->dbConnect, $query_check);
		if ($query_check_run)
		{
			$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
			if($data_check[0] >= 1) {
				$error['order_idErr'] = "* This order detail already exists!";
				$error['error'] = "error";
			}
		}
		else
		{   
			$error['error'] = "error";
			$error['queryErr'] = " Error query check exist order detail: ".$this->dbConnect->error;
		}

		if ($error['error'] == "success") {
			$total_price = $price*$quantity;
			$query = "INSERT INTO ".$this->dbTable." 
										(order_id,
										product_id, 
										total_price,
										quantity,
										price)
							VALUES 		('$order_id',
										'$product_id',
										'$total_price',
										'$quantity',
										'$price')
										 ";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query insert order detail: ".$this->dbConnect->error;
			}

			$error = $this->validatePriceQuantityOrder($order_id, $price, $quantity, $error);
			if ($error['error'] == "success") {
				$error = $this->updateTotalPriceQuantityOrder($order_id, $error);
			}
		}

		if ($error['error'] == "success"){
			$this->dbConnect->commit();
		}
		else {
			$this->dbConnect->rollback();
		}
		echo json_encode($error);
	}

	public function updateData(){
		$error = array(
			'error' 			=> 'success',
			'queryErr'			=> '',
			'product_id_oldErr'	=> '',
			'order_id_oldErr'	=> '',
			'product_id_newErr'	=> '',
			'order_id_newErr'	=> '',
			'priceErr'	=> '',
			'quantityErr'		=> ''
		);

		$product_id_old 	= $_POST['product_id_old'];
		$order_id_old		= $_POST['order_id_old'];
		$product_id_new 	= $_POST['product_id_new'];
		$order_id_new		= $_POST['order_id_new'];
		$price 				= $_POST['price'];
		$quantity 			= $_POST['quantity'];

		if (empty($product_id_old) || trim($product_id_old) == "") {
			$error['product_id_oldErr'] = "* Old Product ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $product_id_old)) {
			$error['product_id_oldErr'] = "* Invalid Old Product ID format!";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	".$this->dbTable."
							WHERE 	product_id  = '$product_id_old'
							";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] == 0) {
					$error['product_id_oldErr'] = "* Old Product ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist Old Product ID: ".$this->dbConnect->error;
			}
		}
		
		if (empty($order_id_old) || trim($order_id_old) == "") {
			$error['order_id_oldErr'] = "* Old order ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $order_id_old)) {
			$error['order_id_oldErr'] = "* Invalid Old order ID format!";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	".$this->dbTable."
							WHERE 	order_id  = '$order_id_old'
							";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] == 0) {
					$error['order_id_oldErr'] = "* Old order ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist Old order ID: ".$this->dbConnect->error;
			}
		}

		if (empty($product_id_new) || trim($product_id_new) == "") {
			$error['product_id_newErr'] = "* New Product ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $product_id_new)) {
			$error['product_id_newErr'] = "* Invalid New Product ID format!";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	products
							WHERE 	id  		= '$product_id_new'
							AND		is_deleted 	= '0'";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] == 0) {
					$error['product_id_newErr'] = "* New Product ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist New Product ID: ".$this->dbConnect->error;
			}
		}

		if (empty($order_id_new) || trim($order_id_new) == "") {
			$error['order_id_newErr'] = "* New order ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $order_id_new)) {
			$error['order_id_newErr'] = "* Invalid New order ID format!";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	orders
							WHERE 	id  		= '$order_id_new'
							AND		is_deleted 	= '0'";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] == 0) {
					$error['order_id_newErr'] = "* New order ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist New order ID: ".$this->dbConnect->error;
			}
		}

		if (empty($price) || trim($price) == "") {
			$error['priceErr'] = "* Price is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[-+]?[0-9]+\.[0-9]+$/",$price)) {
			$error['priceErr'] = "* Invalid price format! Input values ​​are accurate to 1-2 decimal places.";
			$error['error'] = "error";
		}

		if (empty($quantity) || trim($quantity) == "") {
			$error['quantityErr'] = "* Quantity is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $quantity) || $quantity < 0) {
			$error['quantityErr'] = "* Invalid quantity format!";
			$error['error'] = "error";
		}
		else if ($quantity > 2000000000) {
			$error['quantityErr'] = "* Invalid quantity format! Limited to 2,000,000,000";
			$error['error'] = "error";
		}

		if ($error['error'] == "success") {
			$total_price = $price*$quantity;
			$query = "UPDATE ".$this->dbTable." SET 	order_id   		= '$order_id_new',
														product_id   	= '$product_id_new',
														total_price 	= '$total_price',
														quantity	 	= '$quantity',
														price			= '$price'
												WHERE   order_id        = '$order_id_old'
												AND  	product_id  	= '$product_id_old'
												 ";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query update order detail: ".$this->dbConnect->error;
			}
		
			$error = $this->validatePriceQuantityOrder($order_id_new, $price, $quantity, $error);
			if ($error['error'] == "success") {
				$error = $this->updateTotalPriceQuantityOrder($order_id_old, $error);
				$error = $this->updateTotalPriceQuantityOrder($order_id_new, $error);
			}
		}

		if ($error['error'] == "success"){
			$this->dbConnect->commit();
		}
		else {
			$this->dbConnect->rollback();
		}
		echo json_encode($error);
	}
	
	public function deleteData(){
		$error = array(
			'error' 			=> 'success',
			'queryErr'			=> '',
			'product_idErr'		=> '',
			'order_idErr'		=> '',
			'total_priceErr'	=> '',
			'quantityErr'		=> ''
		);

		$product_id 	= $_POST['product_id'];
		$order_id		= $_POST['order_id'];
		$total_price 	= $_POST['total_price'];
		$quantity 		= $_POST['quantity'];

		if (empty($product_id) || trim($product_id) == "") {
			$error['product_idErr'] = "* Product ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $product_id)) {
			$error['product_idErr'] = "* Invalid Product ID format!";
			$error['error'] = "error";
		}
		
		if (empty($order_id) || trim($order_id) == "") {
			$error['order_idErr'] = "* Order ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $order_id)) {
			$error['order_idErr'] = "* Invalid order ID format!";
			$error['error'] = "error";
		}
		
		$query_check =  "SELECT count(1) 
						FROM 	".$this->dbTable."
						WHERE 	product_id   = '$product_id'
						AND  	order_id  	 = '$order_id'";
		$query_check_run = mysqli_query($this->dbConnect, $query_check);
		if ($query_check_run)
		{
			$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
			if($data_check[0] == 0) {
				$error['order_idErr'] = "* This order detail not exist!";
				$error['error'] = "error";
			}
		}
		else
		{   
			$error['error'] = "error";
			$error['queryErr'] = " Error query check exist delete order detail: ".$this->dbConnect->error;
		}

		if ($error['error'] == "success") {
			$query =    "DELETE FROM 	".$this->dbTable."
								WHERE 	product_id 	= '$product_id' 
								AND 	order_id 	= '$order_id'";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query delete order detail: ".$this->dbConnect->error;
			}
			
			
			$error = $this->updateTotalPriceQuantityOrder($order_id, $error);
		}

		if ($error['error'] == "success"){
			$this->dbConnect->commit();
		}
		else {
			$this->dbConnect->rollback();
		}
		echo json_encode($error);
	}

	private function updateTotalPriceQuantityOrder($order_id, $error) {
		$query = "UPDATE orders SET 	total_price 	= (SELECT sum(total_price) FROM order_detail WHERE order_id = '$order_id'), 
										total_quantity	= (SELECT sum(quantity) FROM order_detail WHERE order_id = '$order_id'), 
										updated_date 	= now() 
								WHERE 	id = '$order_id'
								 ";
		$query_run = mysqli_query($this->dbConnect, $query);
		if (!$query_run) {
			$error['error'] = "error";
			$error['queryErr'] = " Error query update total price and quantity table order: ".$this->dbConnect->error;
		}
		return $error;
	}

	private function validatePriceQuantityOrder($order_id, $price, $quantity, $error){
		$total_price_detail_order = $price*$quantity;
		if ($total_price_detail_order < 0){
			$error['priceErr'] = "* Not negative numbers, limited to 13 whole digits";
			$error['error'] = "error";
		}
		else if ($total_price_detail_order >= 10000000000000) {
			$error['priceErr'] = "* The total price of ORDER DETTAIL exceeds the allowed value.";
			$error['error'] = "error";
		}
		else {
			$total_price_order = 0;
			$total_quantity_order = 0;
			$query = 	"SELECT sum(total_price) 	total_price_order,
								sum(quantity)		total_quantity_order
						FROM 	order_detail 
						WHERE	order_id = '$order_id'";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query get total_price_order: ".$this->dbConnect->error;
			}
			else {
				if ($query_run->num_rows == 1) {
					while($row = $query_run->fetch_assoc()) {
						$total_price_order 		= $row["total_price_order"];
						$total_quantity_order	= $row["total_quantity_order"];
					}
				}
				else if ($query_run->num_rows == 0) {
					$error['error'] = "error";
					$error['queryErr'] = "* Error check total price quantity on order: Not found.";
				}
				else {
					$error['error'] = "error";
					$error['queryErr'] = "* Error check total price quantity on order: Exception.";
				}
			}

			if ($total_price_order >= 10000000000000){
				$error['error'] = "error";
				$error['priceErr'] = "* The total price of ORDER exceeds the allowed value.";
			}
			if ($total_quantity_order > 2000000000){
				$error['error'] = "error";
				$error['quantityErr'] = "* The total quantity of ORDER exceeds the allowed value.";
			}
		}

		return $error;
	}
}
?>