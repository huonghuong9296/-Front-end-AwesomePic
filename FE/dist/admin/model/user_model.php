<?php
require('config.php');
class Data extends Dbconfig {	
    protected $hostName;
    protected $userName;
    protected $password;
	protected $dbName;
	private $dbTable = 'users';
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
								firstname,
								lastname,
								phone,
								address,
								city,
								country,
								created_date,
								updated_date
					FROM		".$this->dbTable." 		
					WHERE 		is_deleted = '0'";
		if(!empty($_POST["search"]["value"])){
			$query .= ' AND (id LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR username LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR AES_DECRYPT(password, "secret") LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR email LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR firstname LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR lastname LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR phone LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR address LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR city LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR country LIKE "%'.$_POST["search"]["value"].'%") ';			
		}

		$colArr = ['id', 'id', 'username', 'password', 'email', 'firstname', 'lastname', 'phone', 
					'address', 'city', 'country', 'created_date', 'updated_date'];
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
			$error = " Error select user search: ".$this->dbConnect->error;
			echo json_encode($error);
		}
		
		$query1 = "SELECT * FROM ".$this->dbTable." WHERE is_deleted = '0' ";
		$result1 = mysqli_query($this->dbConnect, $query1);
		if (!$result1) {
			$error = " Error select user numRows: ".$this->dbConnect->error;
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
			$dataRows[] = $data['firstname'];
			$dataRows[] = $data['lastname'];
			$dataRows[] = $data['phone'];
			$dataRows[] = $data['address'];
			$dataRows[] = $data['city'];
			$dataRows[] = $data['country'];
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

	public function getItem(){
		if($_POST["id"]) {
			$query = "
				SELECT 	id,
						username,
						AES_DECRYPT(password, 'secret') password,
						email,
						firstname,
						lastname,
						phone,
						address,
						city,
						country,
						created_date,
						updated_date
				FROM ".$this->dbTable." 
				WHERE id = '".$_POST["id"]."'";
			$result = mysqli_query($this->dbConnect, $query);	
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo json_encode($row);
		}
	}

	public function addData(){
		$error = array(
			'error' 		=> 'success',
			'queryErr'		=> '',
			'idErr'			=> '',
			'firstnameErr' 	=> '',
			'lastnameErr'	=> '',
			'usernameErr' 	=> '',
			'passwordErr' 	=> '',
			'emailErr' 		=> '',
			'phoneErr' 		=> '',
			'addressErr' 	=> '',
			'cityErr' 		=> '',
			'countryErr' 	=> ''
		);

        $firstname 	= $_POST['firstname'];
		$lastname 	= $_POST['lastname'];
		$username 	= $_POST['username'];
        $password 	= $_POST['password'];
        $email 		= $_POST['email'];
        $phone 		= $_POST['phone'];
        $address 	= $_POST['address'];
        $city 		= $_POST['city'];
		$country 	= $_POST['country'];

		if (empty($firstname) || trim($firstname) == "") {
			$error['firstnameErr'] = " First name is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[a-zA-Z]{1,20}$/",$firstname)) {
			$error['firstnameErr'] = " Only letters allowed. Limited to 20 characters.";
			$error['error'] = "error";
		}
		
		if (empty($lastname) || trim($lastname) == "") {
			$error['lastnameErr'] = " Last name is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[a-zA-Z-' ]{1,32}$/",$lastname)) {
			$error['lastnameErr'] = " Only letters and white space allowed. Limited to 32 characters.";
			$error['error'] = "error";
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

		if (empty($phone) || trim($phone) == "") {
			$error['phoneErr'] = " Phone is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]{6,12}$/", $phone)) {
			$error['phoneErr'] = " Invalid phone format! From 6-12 numbers.";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	".$this->dbTable."
							WHERE 	phone   	= '$phone'
							AND  	is_deleted 	= '0'";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] >= 1) {
					$error['phoneErr'] = " Phone already exists!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist phone: ".$this->dbConnect->error;
			}
		}

		if (strlen($address) > 100) {
			$error['addressErr'] = " Invalid address! Limited to 100 characters";
			$error['error'] = "error";
		}
		if (strlen($city) > 32) {
			$error['cityErr'] = " Invalid city! Limited to 32 characters";
			$error['error'] = "error";
		}
		if (strlen($country) > 32) {
			$error['countryErr'] = " Invalid country! Limited to 32 characters";
			$error['error'] = "error";
		}

		if ($error['error'] == "success") {
			$query = "INSERT INTO ".$this->dbTable." 
										(id, 
										username, 
										email, 
										password, 
										firstname, 
										lastname, 
										phone, 
										address, 
										city, 
										country,
										is_deleted, 
										created_date, 
										updated_date) 
							VALUES 		(NULL,
										'$username',
										'$email',
										AES_ENCRYPT('$password', 'secret'),
										'$firstname',
										'$lastname',
										'$phone',
										'$address',
										'$city',
										'$country',
										'0',
										now(),
										NULL)";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query insert user: ".$this->dbConnect->error;
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
			'firstnameErr' 	=> '',
			'lastnameErr'	=> '',
			'usernameErr' 	=> '',
			'passwordErr' 	=> '',
			'emailErr' 		=> '',
			'phoneErr' 		=> '',
			'addressErr' 	=> '',
			'cityErr' 		=> '',
			'countryErr' 	=> ''
		);
		
		$id 		= $_POST['id'];
        $firstname 	= $_POST['firstname'];
		$lastname 	= $_POST['lastname'];
		$username 	= $_POST['username'];
        $password 	= $_POST['password'];
        $email 		= $_POST['email'];
        $phone 		= $_POST['phone'];
        $address 	= $_POST['address'];
        $city 		= $_POST['city'];
		$country 	= $_POST['country'];

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

		if (empty($firstname) || trim($firstname) == "") {
			$error['firstnameErr'] = " First name is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[a-zA-Z]{1,20}$/",$firstname)) {
			$error['firstnameErr'] = " Only letters allowed. Limited to 20 characters.";
			$error['error'] = "error";
		}
		
		if (empty($lastname) || trim($lastname) == "") {
			$error['lastnameErr'] = " Last name is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[a-zA-Z-' ]{1,32}$/",$lastname)) {
			$error['lastnameErr'] = " Only letters and white space allowed. Limited to 32 characters.";
			$error['error'] = "error";
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

		if (empty($phone) || trim($phone) == "") {
			$error['phoneErr'] = " Phone is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]{6,12}$/", $phone)) {
			$error['phoneErr'] = " Invalid phone format! From 6-12 numbers.";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	".$this->dbTable."
							WHERE 	phone   	= '$phone'
							AND  	is_deleted	= '0'
							AND		id		 	!= '$id'";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] >= 1) {
					$error['phoneErr'] = " Phone already exists!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist phone: ".$this->dbConnect->error;
			}
		}

		if (strlen($address) > 100) {
			$error['addressErr'] = " Invalid address! Limited to 100 characters";
			$error['error'] = "error";
		}
		if (strlen($city) > 32) {
			$error['cityErr'] = " Invalid city! Limited to 32 characters";
			$error['error'] = "error";
		}
		if (strlen($country) > 32) {
			$error['countryErr'] = " Invalid country! Limited to 32 characters";
			$error['error'] = "error";
		}

		if ($error['error'] == "success") {
			$query = "UPDATE ".$this->dbTable." SET 	username   	= '$username',
														email       = '$email',
														password    = AES_ENCRYPT('$password', 'secret'),
														firstname   = '$firstname',
														lastname    = '$lastname',
														phone       = '$phone',
														address     = '$address',
														city        = '$city',
														country     = '$country',
														updated_date= now()
												WHERE   id          = '$id'
												AND  	is_deleted  = '0'";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query update user: ".$this->dbConnect->error;
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
			'firstnameErr' 	=> '',
			'lastnameErr'	=> '',
			'usernameErr' 	=> '',
			'passwordErr' 	=> '',
			'emailErr' 		=> '',
			'phoneErr' 		=> '',
			'addressErr' 	=> '',
			'cityErr' 		=> '',
			'countryErr' 	=> ''
		);
		
		$id 		= $_POST['id'];
        $firstname 	= $_POST['firstname'];
		$lastname 	= $_POST['lastname'];
		$username 	= $_POST['username'];
        $password 	= $_POST['password'];
        $email 		= $_POST['email'];
        $phone 		= $_POST['phone'];
        $address 	= $_POST['address'];
        $city 		= $_POST['city'];
		$country 	= $_POST['country'];

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
				$error['queryErr'] = " Error query update to delete user: ".$this->dbConnect->error;
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