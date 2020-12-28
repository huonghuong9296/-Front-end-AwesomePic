<?php
require('config.php');
class Data extends Dbconfig {	
    protected $hostName;
    protected $userName;
    protected $password;
	protected $dbName;
	private $dbTable = 'products';
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
            } else{
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
		
		$query = "SELECT		id,
								NAME,
								src,
								price,
								currency,
								description,
								created_date,
								updated_date
					FROM		".$this->dbTable." 		
					WHERE 		is_deleted = '0'";
		if(!empty($_POST["search"]["value"])){
			$query .= ' AND (id LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR NAME LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR src LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR price LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR currency LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR created_date LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR updated_date LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR description LIKE "%'.$_POST["search"]["value"].'%") ';			
		}
		
		$colArr = ['id', 'id', 'id', 'NAME', 'src', 'price', 'currency', 'description', 'id', 'id', 'created_date', 'updated_date'];
		if(!empty($_POST["order"])){
			$query .= 'ORDER BY '.$colArr[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
		}
		else {
			$query .= 'ORDER BY id DESC ';
		}
		if($_POST["length"] != -1){
			$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $query);
		if (!$result) {
			$error = " Error select product search: ".$this->dbConnect->error;
			echo json_encode($error);
		}
		
		$query1 = "SELECT * FROM ".$this->dbTable." WHERE is_deleted = '0' ";
		$result1 = mysqli_query($this->dbConnect, $query1);
		if (!$result1) {
			$error = " Error select product numRows: ".$this->dbConnect->error;
			echo json_encode($error);
		}

		$numRows = mysqli_num_rows($result1);
		
		$dataTable = array();	
		while( $data = mysqli_fetch_assoc($result) ) {		
			$dataRows = array();			
			$dataRows[] = $data['id'];
			$dataRows[] = '<a class="btn btn-sm btn-info edt-btn-admin"><i class="fa fa-edit"></i></a>
						   <a class="btn btn-sm btn-danger del-btn-admin"><i class="fa fa-trash"></i></a>';
			$dataRows[] = '<img class="product-img-admin" src="'.$data['src'].'" alt="'.$data['NAME'].'">';
			$dataRows[] = $data['NAME'];
			$dataRows[] = $data['src'];
			$dataRows[] = $data['price'];
			$dataRows[] = $data['currency'];
			$dataRows[] = $data['description'];
		
			$category = "|";
			$query_category = 	"SELECT		c.NAME category_name
								FROM		".$this->dbTable." 	a,
											products_categories b,
											categories			c 		
								WHERE 		b.product_id	= a.id
								AND			b.category_id	= c.id
								AND			a.id			= {$data['id']}
								";
			$result_category = mysqli_query($this->dbConnect, $query_category);
			if (!$result_category) {
				$error = " Error select category: ".$this->dbConnect->error;
				echo json_encode($error);
			}
			while( $data_category = mysqli_fetch_assoc($result_category) ) {
				$category .= " ".$data_category['category_name']." |";
			}
			if ($category == "|") {
				$category = "";
			}
			$dataRows[] = $category;

			$tag = "|";
			$query_tag = 		"SELECT		c.title 			tag_title 
								FROM		".$this->dbTable." 	a,
											products_tags 		b,
											tags				c 		
								WHERE 		b.product_id	= a.id
								AND			b.tag_id		= c.id
								AND			a.id			= {$data['id']}
								";
			$result_tag = mysqli_query($this->dbConnect, $query_tag);
			if (!$result_tag) {
				$error = " Error select tag: ".$this->dbConnect->error;
				echo json_encode($error);
			}
			while( $data_tag = mysqli_fetch_assoc($result_tag) ) {
				$tag .= " ".$data_tag['tag_title']." |";
			}
			if ($tag == "|") {
				$tag = "";
			}
			$dataRows[] = $tag;

			$dataRows[] = $data['created_date'];
			$dataRows[] = $data['updated_date'];
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

	// public function getItem(){
	// 	if($_POST["id"]) {
	// 		$query = "
	// 			SELECT 	id,
	// 					username,
	// 					AES_DECRYPT(password, 'secret') password,
	// 					email,
	// 					firstname,
	// 					lastname,
	// 					phone,
	// 					address,
	// 					city,
	// 					country,
	// 					created_date,
	// 					updated_date
	// 			FROM ".$this->dbTable." 
	// 			WHERE id = '".$_POST["id"]."'";
	// 		$result = mysqli_query($this->dbConnect, $query);	
	// 		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	// 		echo json_encode($row);
	// 	}
	// }

	public function addData(){
		$error = array(
			'error' 		=> 'success',
			'queryErr'		=> '',
			'idErr'			=> '',
			'nameErr' 		=> '',
			'srcErr' 		=> '',
			'priceErr' 		=> '',
			'currencyErr' 	=> '',
			'descriptionErr'=> ''
		);

		$name 		= $_POST['name'];
		$src 		= $_POST['src'];
		$price 		= $_POST['price'];
		$currency 	= $_POST['currency'];
		$description= $_POST['description'];

		if (empty($name) || trim($name) == "") {
			$error['nameErr'] = " Name is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[a-zA-Z0-9\s]{1,50}$/",$name)) {
			$error['nameErr'] = " Only letters, numbers and white space allowed. Limited to 50 characters.";
			$error['error'] = "error";
		}

		if (empty($src) || trim($src) == "") {
			$error['srcErr'] = " SRC is required.";
			$error['error'] = "error";
		}

		if (empty($price) || trim($price) == "") {
			$error['priceErr'] = " Price is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[-+]?[0-9]+\.[0-9]+$/",$price)) {
			$error['priceErr'] = " Invalid price format! Input values ​​are accurate to 1-2 decimal places.";
			$error['error'] = "error";
		}
		else if ($price >= 10000000000000) {
			$error['priceErr'] = " Invalid price format! Limited to 13 whole digits.";
			$error['error'] = "error";
		}

		if (empty($currency) || trim($currency) == "") {
			$error['currencyErr'] = " Currency is required.";
			$error['error'] = "error";
		}
		else if (strlen($currency) > 20) {
			$error['currencyErr'] = " Invalid currency! Limited to 20 characters";
			$error['error'] = "error";
		}

		if (strlen($description) > 1000) {
			$error['descriptionErr'] = " Invalid description! Limited to 1000 characters";
			$error['error'] = "error";
		}

		if ($error['error'] == "success") {
			$query = "INSERT INTO ".$this->dbTable." 
										(id, 
										NAME, 
										src,
										price,
										currency,
										description, 
										is_deleted, 
										created_date, 
										updated_date) 
							VALUES 		(NULL,
										'$name',
										'$src',
										'$price',
										'$currency',
										'$description',
										'0',
										now(),
										NULL)";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query insert product: ".$this->dbConnect->error;
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
			'error' 		=> 'success',
			'queryErr'		=> '',
			'idErr'			=> '',
			'nameErr' 		=> '',
			'srcErr' 		=> '',
			'priceErr' 		=> '',
			'currencyErr' 	=> '',
			'descriptionErr'=> ''
		);
		
		$id 		= $_POST['id'];
		$name 		= $_POST['name'];
		$src 		= $_POST['src'];
		$price 		= $_POST['price'];
		$currency 	= $_POST['currency'];
		$description= $_POST['description'];

		if (empty($id) || trim($id) == "") {
			$error['idErr'] = " ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $id)) {
			$error['idErr'] = " Invalid ID format!";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	".$this->dbTable."
							WHERE 	id   		= '$id'
							AND  	is_deleted 	= '0'";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] == 0) {
					$error['idErr'] = " Product ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist ID: ".$this->dbConnect->error;
			}
		}

		if (empty($name) || trim($name) == "") {
			$error['nameErr'] = " Name is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[a-zA-Z0-9\s]{1,50}$/",$name)) {
			$error['nameErr'] = " Only letters, numbers and white space allowed. Limited to 50 characters.";
			$error['error'] = "error";
		}

		if (empty($src) || trim($src) == "") {
			$error['srcErr'] = " SRC is required.";
			$error['error'] = "error";
		}

		if (empty($price) || trim($price) == "") {
			$error['priceErr'] = " Price is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[-+]?[0-9]+\.[0-9]+$/",$price)) {
			$error['priceErr'] = " Invalid price format! Input values ​​are accurate to 1-2 decimal places.";
			$error['error'] = "error";
		}
		else if ($price >= 10000000000000) {
			$error['priceErr'] = " Invalid price format! Limited to 13 whole digits.";
			$error['error'] = "error";
		}

		if (empty($currency) || trim($currency) == "") {
			$error['currencyErr'] = " Currency is required.";
			$error['error'] = "error";
		}
		else if (strlen($currency) > 20) {
			$error['currencyErr'] = " Invalid currency! Limited to 20 characters";
			$error['error'] = "error";
		}

		if (strlen($description) > 1000) {
			$error['descriptionErr'] = " Invalid description! Limited to 1000 characters";
			$error['error'] = "error";
		}

		if ($error['error'] == "success") {
			$query = "UPDATE ".$this->dbTable." SET 	NAME   		= '$name',
														src   		= '$src',
														price   	= '$price',
														currency   	= '$currency',
														description = '$description',
														updated_date= now()
												WHERE   id          = '$id'
												AND  	is_deleted  = '0'";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query update product: ".$this->dbConnect->error;
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
			'error' 		=> 'success',
			'queryErr'		=> '',
			'idErr'			=> '',
			'nameErr' 		=> '',
			'srcErr' 		=> '',
			'priceErr' 		=> '',
			'currencyErr' 	=> '',
			'descriptionErr'=> ''
		);
		
		$id 		= $_POST['id'];
		$name 		= $_POST['name'];
		$src 		= $_POST['src'];
		$price 		= $_POST['price'];
		$currency 	= $_POST['currency'];
		$description= $_POST['description'];

		if (empty($id) || trim($id) == "") {
			$error['idErr'] = " ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $id)) {
			$error['idErr'] = " Invalid ID format!";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	".$this->dbTable."
							WHERE 	id   		= '$id'
							AND  	is_deleted 	= '0'";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] == 0) {
					$error['idErr'] = " Category ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist ID: ".$this->dbConnect->error;
			}
		}

		if ($error['error'] == "success") {
			$query =    "UPDATE ".$this->dbTable." 	SET		is_deleted   = '1',
															deleted_date = now()
													WHERE   id 	         = '$id'
													AND     is_deleted	 = '0'";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query update to delete product: ".$this->dbConnect->error;
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

	public function productList(){		
		
		$query = "SELECT		id,
								NAME,
								src,
								price,
								currency,
								description,
								created_date,
								updated_date
					FROM		".$this->dbTable." 		
					WHERE 		is_deleted = '0'";
		$result = mysqli_query($this->dbConnect, $query);
		if (!$result) {
			$error = " Error select productlist search: ".$this->dbConnect->error;
			echo json_encode($error);
		}
		
		$dataProduct = array();	
		while( $data = mysqli_fetch_assoc($result) ) {		
			$dataRows = array();			
			$dataRows[] = $data['id'];
			$dataRows[] = $data['NAME'];
			$dataRows[] = $data['src'];
			$dataRows[] = $data['price'];
			$dataRows[] = $data['currency'];
			$dataRows[] = $data['description'];
			$dataRows[] = $data['created_date'];
			$dataRows[] = $data['updated_date'];
			$dataProduct[] = $dataRows;
		}
		// $output = array(
		// 	"draw"				=>	intval($_POST["draw"]),
		// 	"recordsTotal"  	=>  $numRows,
		// 	"recordsFiltered" 	=> 	$numRows,
		// 	"data"    			=> 	$dataProduct
		// );

		if ($error['error'] == "success") {
			$this->dbConnect->commit();
		}
		else {
			$this->dbConnect->rollback();
		}
		echo json_encode($dataProduct);
	}
}
?>