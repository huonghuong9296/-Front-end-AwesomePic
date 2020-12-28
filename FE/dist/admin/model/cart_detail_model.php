<?php
require('config.php');
class Data extends Dbconfig {	
    protected $hostName;
    protected $userName;
    protected $password;
	protected $dbName;
	private $dbTable = 'cart_detail';
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
		
		$query = "SELECT		a.cart_id			cart_id,
								c.username			username,
								a.product_id		product_id,
								d.NAME				product_name,
								d.price*a.quantity	total_price,
								a.quantity			quantity,
								d.price				price 
					FROM		".$this->dbTable."	a,
								carts				b,
								users				c,
								products			d 		
					WHERE 		a.cart_id	 	= b.id
					AND			a.product_id	= d.id
					AND			b.user_id		= c.id
					";
		if(!empty($_POST["search"]["value"])){
			$query .= ' AND (a.cart_id LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR c.username LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR a.product_id LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR d.NAME LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR d.price*a.quantity LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR d.price LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR a.quantity LIKE "%'.$_POST["search"]["value"].'%") ';			
		}
		
		$colArr = ['cart_id', 'cart_id', 'username', 'product_id', 'product_name', 'total_price', 'quantity', 'price'];
		if(!empty($_POST["order"])){
			$query .= 'ORDER BY '.$colArr[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
		}
		else {
			$query .= 'ORDER BY cart_id DESC ';
		}
		if($_POST["length"] != -1){
			$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $query);
		if (!$result) {
			$error = " Error select cart detail search: ".$this->dbConnect->error;
			echo json_encode($error);
		}
		
		$query1 = "SELECT * FROM ".$this->dbTable." WHERE 1 ";
		$result1 = mysqli_query($this->dbConnect, $query1);
		if (!$result1) {
			$error = " Error select cart detail numRows: ".$this->dbConnect->error;
			echo json_encode($error);
		}

		$numRows = mysqli_num_rows($result1);
		
		$dataTable = array();	
		while( $data = mysqli_fetch_assoc($result) ) {		
			$dataRows = array();			
			$dataRows[] = '<a class="btn btn-sm btn-info edt-btn-admin"><i class="fa fa-edit"></i></a>
						   <a class="btn btn-sm btn-danger del-btn-admin"><i class="fa fa-trash"></i></a>';
			$dataRows[] = $data['cart_id'];
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
			'cart_idErr'		=> '',
			'product_idErr'		=> '',
			'quantityErr'		=> ''
		);

		$cart_id 		= $_POST['cart_id'];
		$product_id 	= $_POST['product_id'];
		$quantity 		= $_POST['quantity'];

		if (empty($cart_id) || trim($cart_id) == "") {
			$error['cart_idErr'] = "* Cart ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $cart_id)) {
			$error['cart_idErr'] = "* Invalid cart ID format!";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	carts
							WHERE 	id   		= '$cart_id'
							 ";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] == 0) {
					$error['cart_idErr'] = "* Cart ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist cart ID: ".$this->dbConnect->error;
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
						AND  	cart_id  		= '$cart_id'";
		$query_check_run = mysqli_query($this->dbConnect, $query_check);
		if ($query_check_run)
		{
			$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
			if($data_check[0] >= 1) {
				$error['cart_idErr'] = "* This cart detail already exists!";
				$error['error'] = "error";
			}
		}
		else
		{   
			$error['error'] = "error";
			$error['queryErr'] = " Error query check exist cart detail: ".$this->dbConnect->error;
		}

		if ($error['error'] == "success") {
			$query = "INSERT INTO ".$this->dbTable." 
										(cart_id,
										product_id, 
										quantity)
							VALUES 		('$cart_id',
										'$product_id',
										'$quantity')
										 ";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query insert cart detail: ".$this->dbConnect->error;
			}

			$error = $this->validatePriceQuantityCart($cart_id, $quantity, $error);
			if ($error['error'] == "success") {
				$error = $this->updateTotalPriceQuantityCart($cart_id, $error);
			}
		}

		if ($error['error'] == "success") {
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
			'cart_id_oldErr'	=> '',
			'product_id_newErr'	=> '',
			'cart_id_newErr'	=> '',
			'quantityErr'		=> ''
		);

		$product_id_old 	= $_POST['product_id_old'];
		$cart_id_old		= $_POST['cart_id_old'];
		$product_id_new 	= $_POST['product_id_new'];
		$cart_id_new		= $_POST['cart_id_new'];
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
		
		if (empty($cart_id_old) || trim($cart_id_old) == "") {
			$error['cart_id_oldErr'] = "* Old cart ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $cart_id_old)) {
			$error['cart_id_oldErr'] = "* Invalid Old cart ID format!";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	".$this->dbTable."
							WHERE 	cart_id  = '$cart_id_old'
							";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] == 0) {
					$error['cart_id_oldErr'] = "* Old cart ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist Old cart ID: ".$this->dbConnect->error;
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

		if (empty($cart_id_new) || trim($cart_id_new) == "") {
			$error['cart_id_newErr'] = "* New cart ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $cart_id_new)) {
			$error['cart_id_newErr'] = "* Invalid New cart ID format!";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	carts
							WHERE 	id  		= '$cart_id_new'
							 ";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] == 0) {
					$error['cart_id_newErr'] = "* New cart ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist New cart ID: ".$this->dbConnect->error;
			}
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
			$query = "UPDATE ".$this->dbTable." SET 	cart_id   		= '$cart_id_new',
														product_id   	= '$product_id_new',
														quantity	 	= '$quantity'
												WHERE   cart_id        = '$cart_id_old'
												AND  	product_id  	= '$product_id_old'
												 ";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query update cart detail: ".$this->dbConnect->error;
			}
		
			$error = $this->validatePriceQuantityCart($cart_id_new, $quantity, $error);
			if ($error['error'] == "success") {
				$error = $this->updateTotalPriceQuantityCart($cart_id_old, $error);
				$error = $this->updateTotalPriceQuantityCart($cart_id_new, $error);
			}
		}

		if ($error['error'] == "success") {
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
			'cart_idErr'		=> '',
			'quantityErr'		=> ''
		);

		$product_id 	= $_POST['product_id'];
		$cart_id		= $_POST['cart_id'];
		$quantity 		= $_POST['quantity'];

		if (empty($product_id) || trim($product_id) == "") {
			$error['product_idErr'] = "* Product ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $product_id)) {
			$error['product_idErr'] = "* Invalid Product ID format!";
			$error['error'] = "error";
		}
		
		if (empty($cart_id) || trim($cart_id) == "") {
			$error['cart_idErr'] = "* Cart ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $cart_id)) {
			$error['cart_idErr'] = "* Invalid cart ID format!";
			$error['error'] = "error";
		}
		
		$query_check =  "SELECT count(1) 
						FROM 	".$this->dbTable."
						WHERE 	product_id   = '$product_id'
						AND  	cart_id  	 = '$cart_id'";
		$query_check_run = mysqli_query($this->dbConnect, $query_check);
		if ($query_check_run)
		{
			$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
			if($data_check[0] == 0) {
				$error['cart_idErr'] = "* This cart detail not exist!";
				$error['error'] = "error";
			}
		}
		else
		{   
			$error['error'] = "error";
			$error['queryErr'] = " Error query check exist delete cart detail: ".$this->dbConnect->error;
		}

		if ($error['error'] == "success") {
			$query =    "DELETE FROM 	".$this->dbTable."
								WHERE 	product_id 	= '$product_id' 
								AND 	cart_id 	= '$cart_id'";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query delete cart detail: ".$this->dbConnect->error;
			}
			
			$error = $this->updateTotalPriceQuantityCart($cart_id, $error);
		}

		if ($error['error'] == "success") {
			$this->dbConnect->commit();
		}
		else {
			$this->dbConnect->rollback();
		}
		echo json_encode($error);
	}

	private function updateTotalPriceQuantityCart($cart_id, $error) {
		$query = "UPDATE carts SET 		total_price 	= 	(SELECT 	sum(b.price*a.quantity) 
																FROM 	cart_detail a,
																		products	 b
																WHERE 	a.cart_id 	 = '$cart_id'
																AND		a.product_id = b.id 		
															), 
										total_quantity	= 	(SELECT sum(quantity) FROM cart_detail WHERE cart_id = '$cart_id')
								WHERE 	id = '$cart_id'
								 ";
		$query_run = mysqli_query($this->dbConnect, $query);
		if (!$query_run) {
			$error['error'] = "error";
			$error['queryErr'] = " Error query update total price and quantity table cart: ".$this->dbConnect->error;
		}
		return $error;
	}

	private function validatePriceQuantityCart($cart_id, $quantity, $error){
		$total_price_cart = 0;
		$total_quantity_cart = 0;
		$query = 	"SELECT 	sum(b.price*a.quantity) total_price_cart,
								sum(a.quantity)			total_quantity_cart
					FROM 	cart_detail a,
							products	 b
					WHERE 	a.cart_id 	 = '$cart_id'
					AND		a.product_id = b.id ";
		$query_run = mysqli_query($this->dbConnect, $query);
		if (!$query_run) {
			$error['error'] = "error";
			$error['queryErr'] = " Error query get total_price_quantity_cart: ".$this->dbConnect->error;
		}
		else {
			if ($query_run->num_rows == 1) {
				while($row = $query_run->fetch_assoc()) {
					$total_price_cart 		= $row["total_price_cart"];
					$total_quantity_cart	= $row["total_quantity_cart"];
				}
			}
			else if ($query_run->num_rows == 0) {
				$error['error'] = "error";
				$error['queryErr'] = "* Error check total price quantity on cart: Not found.";
			}
			else {
				$error['error'] = "error";
				$error['queryErr'] = "* Error check total price quantity on cart: Exception.";
			}
		}

		if ($total_price_cart >= 10000000000000){
			$error['error'] = "error";
			$error['quantityErr'] = "* The total price of CART exceeds the allowed value.";
		}
		else if ($total_quantity_cart > 2000000000){
			$error['error'] = "error";
			$error['quantityErr'] = "* The total quantity of CART exceeds the allowed value.";
		}

		return $error;
	}
}
?>