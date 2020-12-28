<?php
require('config.php');
class Data extends Dbconfig {	
    protected $hostName;
    protected $userName;
    protected $password;
	protected $dbName;
	private $dbTable = 'admins';
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
								username,
								AES_DECRYPT(password, 'secret') password,
								email,
								created_date,
								updated_date
					FROM		".$this->dbTable." 		
					WHERE 		is_deleted = '0'";
		if(!empty($_POST["search"]["value"])){
			$query .= ' AND (id LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR username LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR AES_DECRYPT(password, "secret") LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR email LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR created_date LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR updated_date LIKE "%'.$_POST["search"]["value"].'%") ';		
		}

		$colArr = ['id', 'id', 'username', 'password', 'email', 'created_date', 'updated_date'];
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
			$error = " Error select admin search: ".$this->dbConnect->error;
			echo json_encode($error);
		}
		
		$query1 = "SELECT * FROM ".$this->dbTable." WHERE is_deleted = '0' ";
		$result1 = mysqli_query($this->dbConnect, $query1);
		if (!$result1) {
			$error = " Error select admin numRows: ".$this->dbConnect->error;
			echo json_encode($error);
		}

		$numRows = mysqli_num_rows($result1);
		
		$dataTable = array();	
		while( $data = mysqli_fetch_assoc($result) ) {		
			$dataRows = array();			
			$dataRows[] = $data['id'];
			$dataRows[] = '<a class="btn btn-sm btn-info edt-btn-admin"><i class="fa fa-edit"></i></a>
						<a class="btn btn-sm btn-danger del-btn-admin"><i class="fa fa-trash"></i></a>';
			$dataRows[] = $data['username']; 
			$dataRows[] = $data['password'];
			$dataRows[] = $data['email'];	
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

	public function addData(){
		$error = array(
			'error' 		=> 'success',
			'queryErr'		=> '',
			'idErr'			=> '',
			'usernameErr' 	=> '',
			'passwordErr' 	=> '',
			'emailErr' 		=> ''
		);

		$username 	= $_POST['username'];
        $password 	= $_POST['password'];
        $email 		= $_POST['email'];

		if (empty($username) || trim($username) == ""){
			$error['usernameErr'] = " Username is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[A-Za-z0-9_\.]{6,32}$/", $username)) {
			$error['usernameErr'] = " Invalid username format! String from 6-32 characters.";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	".$this->dbTable."
							WHERE 	username   = '$username'
							AND  	is_deleted = '0'";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] >= 1) {
					$error['usernameErr'] = " Username already exists!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist username: ".$this->dbConnect->error;
			}
		}

		if (empty($password) || trim($password) == "") {
			$error['passwordErr'] = " Password is required.";
			$error['error'] = "error";
		}
		else if (strlen($password) < 8 || strlen($password) > 20) {
			$error['passwordErr'] = " Invalid password! String from 8-20 characters.";
			$error['error'] = "error";
		}

		if (empty($email) || trim($email) == "") {
			$error['emailErr'] = " Email is required.";
			$error['error'] = "error";
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error['emailErr'] = " Invalid email format!";
			$error['error'] = "error";
		}
		else if (strlen($email) > 50) {
			$error['emailErr'] = " Invalid email! Limited to 50 characters.";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	".$this->dbTable."
							WHERE 	email   	= '$email'
							AND 	is_deleted 	= '0'";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] >= 1) {
					$error['emailErr'] = " Email already exists!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist email: ".$this->dbConnect->error;
			}
		}

		if ($error['error'] == "success") {
			$query = "INSERT INTO ".$this->dbTable." 
										(id, 
										username, 
										email, 
										password, 
										is_deleted, 
										created_date, 
										updated_date) 
							VALUES 		(NULL,
										'$username',
										'$email',
										AES_ENCRYPT('$password', 'secret'),
										'0',
										now(),
										NULL)";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query insert admin: ".$this->dbConnect->error;
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
			'usernameErr' 	=> '',
			'passwordErr' 	=> '',
			'emailErr' 		=> ''
		);
		
		$id 		= $_POST['id'];
		$username 	= $_POST['username'];
        $password 	= $_POST['password'];
        $email 		= $_POST['email'];

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
					$error['idErr'] = " User ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist ID: ".$this->dbConnect->error;
			}
		}

		if (empty($username) || trim($username) == ""){
			$error['usernameErr'] = " Username is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[A-Za-z0-9_\.]{6,32}$/", $username)) {
			$error['usernameErr'] = " Invalid username format! String from 6-32 characters.";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	".$this->dbTable."
							WHERE 	username	= '$username'
							AND  	is_deleted	= '0'
							AND		id		 	!= '$id'";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] >= 1) {
					$error['usernameErr'] = " Username already exists!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist username: ".$this->dbConnect->error;
			}
		}

		if (empty($password) || trim($password) == "") {
			$error['passwordErr'] = " Password is required.";
			$error['error'] = "error";
		}
		else if (strlen($password) < 8 || strlen($password) > 20) {
			$error['passwordErr'] = " Invalid password! String from 8-20 characters.";
			$error['error'] = "error";
		}

		if (empty($email) || trim($email) == "") {
			$error['emailErr'] = " Email is required.";
			$error['error'] = "error";
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error['emailErr'] = " Invalid email format!";
			$error['error'] = "error";
		}
		else if (strlen($email) > 50) {
			$error['emailErr'] = " Invalid email! Limited to 50 characters.";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	".$this->dbTable."
							WHERE 	email   	= '$email'
							AND  	is_deleted	= '0'
							AND		id		 	!= '$id'";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] >= 1) {
					$error['emailErr'] = " Email already exists!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist email: ".$this->dbConnect->error;
			}
		}

		if ($error['error'] == "success") {
			$query = "UPDATE ".$this->dbTable." SET 	username   	= '$username',
														email       = '$email',
														password    = AES_ENCRYPT('$password', 'secret'),
														updated_date= now()
												WHERE   id          = '$id'
												AND  	is_deleted  = '0'";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query update admin: ".$this->dbConnect->error;
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
			'usernameErr' 	=> '',
			'passwordErr' 	=> '',
			'emailErr' 		=> ''
		);
		
		$id 		= $_POST['id'];
		$username 	= $_POST['username'];
        $password 	= $_POST['password'];
        $email 		= $_POST['email'];
       
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
					$error['idErr'] = " User ID not exist!";
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
				$error['queryErr'] = " Error query update to delete admin: ".$this->dbConnect->error;
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