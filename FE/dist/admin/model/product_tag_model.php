<?php
require('config.php');
class Data extends Dbconfig {	
    protected $hostName;
    protected $userName;
    protected $password;
	protected $dbName;
	private $dbTable = 'products_tags';
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
		
		$query = "SELECT		a.product_id 	product_id,
								b.NAME 			product_name,
								a.tag_id		tag_id,
								c.title			tag_title
					FROM		".$this->dbTable."	a,
								products			b,
								tags				c 		
					WHERE 		a.product_id	= b.id
					AND			a.tag_id	= c.id
					";
		if(!empty($_POST["search"]["value"])){
			$query .= ' AND (a.product_id LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR b.NAME LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR a.tag_id LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR c.NAME LIKE "%'.$_POST["search"]["value"].'%") ';			
		}

		$colArr = ['product_id', 'product_id', 'product_name', 'tag_id', 'tag_title'];
		if(!empty($_POST["order"])){
			$query .= 'ORDER BY '.$colArr[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
		}
		else {
			$query .= 'ORDER BY product_id, tag_id DESC ';
		}
		if($_POST["length"] != -1){
			$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $query);
		if (!$result) {
			$error = " Error select product tag search: ".$this->dbConnect->error;
			echo json_encode($error);
		}
		
		$query1 = "SELECT * FROM ".$this->dbTable." WHERE 1";
		$result1 = mysqli_query($this->dbConnect, $query1);
		if (!$result1) {
			$error = " Error select product tag numRows: ".$this->dbConnect->error;
			echo json_encode($error);
		}

		$numRows = mysqli_num_rows($result1);
		
		$dataTable = array();	
		while( $data = mysqli_fetch_assoc($result) ) {		
			$dataRows = array();			
			$dataRows[] = '<a class="btn btn-sm btn-info edt-btn-admin"><i class="fa fa-edit"></i></a>
						<a class="btn btn-sm btn-danger del-btn-admin"><i class="fa fa-trash"></i></a>';
			$dataRows[] = $data['product_id']; 
			$dataRows[] = $data['product_name'];
			$dataRows[] = $data['tag_id'];
			$dataRows[] = $data['tag_title'];
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
			'error' 		=> 'success',
			'queryErr'		=> '',
			'product_idErr'	=> '',
			'tag_idErr'=> ''
		);

        $product_id 	= $_POST['product_id'];
		$tag_id	= $_POST['tag_id'];

		if (empty($product_id) || trim($product_id) == "") {
			$error['product_idErr'] = " Product ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $product_id)) {
			$error['product_idErr'] = " Invalid Product ID format!";
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
					$error['product_idErr'] = " Product ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist Product ID: ".$this->dbConnect->error;
			}
		}
		
		if (empty($tag_id) || trim($tag_id) == "") {
			$error['tag_idErr'] = " tag ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $tag_id)) {
			$error['tag_idErr'] = " Invalid tag ID format!";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	tags
							WHERE 	id   		= '$tag_id' 
							";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] == 0) {
					$error['tag_idErr'] = " tag ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist tag ID: ".$this->dbConnect->error;
			}
		}

		$query_check =  "SELECT count(1) 
						FROM 	".$this->dbTable."
						WHERE 	product_id   = '$product_id'
						AND  	tag_id  = '$tag_id'";
		$query_check_run = mysqli_query($this->dbConnect, $query_check);
		if ($query_check_run)
		{
			$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
			if($data_check[0] >= 1) {
				$error['product_idErr'] = " This setting already exists!";
				$error['error'] = "error";
			}
		}
		else
		{   
			$error['error'] = "error";
			$error['queryErr'] = " Error query check exist setting: ".$this->dbConnect->error;
		}

		if ($error['error'] == "success") {
			$query = "INSERT INTO ".$this->dbTable." 
										(product_id, 
										tag_id) 
							VALUES 		('$product_id',
										'$tag_id')";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query insert product tag: ".$this->dbConnect->error;
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
			'error' 				=> 'success',
			'queryErr'				=> '',
			'product_id_oldErr'		=> '',
			'tag_id_oldErr'	=> '',
			'product_id_newErr'		=> '',
			'tag_id_newErr'	=> ''
		);

        $product_id_old 	= $_POST['product_id_old'];
		$tag_id_old	= $_POST['tag_id_old'];
		$product_id_new 	= $_POST['product_id_new'];
		$tag_id_new	= $_POST['tag_id_new'];

		if (empty($product_id_old) || trim($product_id_old) == "") {
			$error['product_id_oldErr'] = " Old Product ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $product_id_old)) {
			$error['product_id_oldErr'] = " Invalid Old Product ID format!";
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
					$error['product_id_oldErr'] = " Old Product ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist Old Product ID: ".$this->dbConnect->error;
			}
		}
		
		if (empty($tag_id_old) || trim($tag_id_old) == "") {
			$error['tag_id_oldErr'] = " Old tag ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $tag_id_old)) {
			$error['tag_id_oldErr'] = " Invalid Old tag ID format!";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	".$this->dbTable."
							WHERE 	tag_id  = '$tag_id_old'
							";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] == 0) {
					$error['tag_id_oldErr'] = " Old tag ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist Old tag ID: ".$this->dbConnect->error;
			}
		}

		if (empty($product_id_new) || trim($product_id_new) == "") {
			$error['product_id_newErr'] = " New Product ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $product_id_new)) {
			$error['product_id_newErr'] = " Invalid New Product ID format!";
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
					$error['product_id_newErr'] = " New Product ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist New Product ID: ".$this->dbConnect->error;
			}
		}

		if (empty($tag_id_new) || trim($tag_id_new) == "") {
			$error['tag_id_newErr'] = " New tag ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $tag_id_new)) {
			$error['tag_id_newErr'] = " Invalid New tag ID format!";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	tags
							WHERE 	id  		= '$tag_id_new'
							 ";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] == 0) {
					$error['tag_id_newErr'] = " New tag ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist New tag ID: ".$this->dbConnect->error;
			}
		}

		$query_check =  "SELECT count(1) 
						FROM 	".$this->dbTable."
						WHERE 	product_id   = '$product_id_new'
						AND  	tag_id  = '$tag_id_new'";
		$query_check_run = mysqli_query($this->dbConnect, $query_check);
		if ($query_check_run)
		{
			$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
			if($data_check[0] >= 1) {
				$error['product_id_newErr'] = " This setting already exists!";
				$error['error'] = "error";
			}
		}
		else
		{   
			$error['error'] = "error";
			$error['queryErr'] = " Error query check exist update setting: ".$this->dbConnect->error;
		}

		if ($error['error'] == "success") {
			$query = "UPDATE ".$this->dbTable." SET 	product_id   = '$product_id_new',
														tag_id	 = '$tag_id_new'
												WHERE   product_id   = '$product_id_old'
												AND  	tag_id  = '$tag_id_old'";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query update product tag: ".$this->dbConnect->error;
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
			'product_idErr'	=> '',
			'tag_idErr'=> ''
		);

        $product_id 	= $_POST['product_id'];
		$tag_id	= $_POST['tag_id'];

		if (empty($product_id) || trim($product_id) == "") {
			$error['product_idErr'] = " Product ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $product_id)) {
			$error['product_idErr'] = " Invalid Product ID format!";
			$error['error'] = "error";
		}
		
		if (empty($tag_id) || trim($tag_id) == "") {
			$error['tag_idErr'] = " tag ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $tag_id)) {
			$error['tag_idErr'] = " Invalid tag ID format!";
			$error['error'] = "error";
		}
		
		$query_check =  "SELECT count(1) 
						FROM 	".$this->dbTable."
						WHERE 	product_id   = '$product_id'
						AND  	tag_id  = '$tag_id'";
		$query_check_run = mysqli_query($this->dbConnect, $query_check);
		if ($query_check_run)
		{
			$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
			if($data_check[0] == 0) {
				$error['product_idErr'] = " This setting not exist!";
				$error['error'] = "error";
			}
		}
		else
		{   
			$error['error'] = "error";
			$error['queryErr'] = " Error query check exist delete setting: ".$this->dbConnect->error;
		}

		if ($error['error'] == "success") {
			$query =    "DELETE FROM 	".$this->dbTable."
								WHERE 	product_id 	= '$product_id' 
								AND 	tag_id = '$tag_id'";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query delete product tag: ".$this->dbConnect->error;
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
}
?>