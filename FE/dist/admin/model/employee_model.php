<?php
require('config.php');
class Data extends Dbconfig {	
    protected $hostName;
    protected $userName;
    protected $password;
	protected $dbName;
	private $dbTable = 'employees';
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
								firstname,
								lastname,
								job_title, 
								phone,
								facebook,
								instagram,
								twitter,
								description,
								created_date,
								updated_date
					FROM		".$this->dbTable." 		
					WHERE 		is_deleted = '0'";
		if(!empty($_POST["search"]["value"])){
			$query .= ' AND (id LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR firstname LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR lastname LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR job_title LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR phone LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR facebook LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR instagram LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR twitter LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR created_date LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR updated_date LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR description LIKE "%'.$_POST["search"]["value"].'%") ';			
		}

		$colArr = ['id', 'id', 'firstname', 'lastname', 'job_title', 'phone', 'facebook', 'instagram', 'twitter', 
					'description', 'created_data', 'updated_date'];
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
			$error = " Error select employee search: ".$this->dbConnect->error.$query;
			echo json_encode($error);
		}
		
		$query1 = "SELECT * FROM ".$this->dbTable." WHERE is_deleted = '0' ";
		$result1 = mysqli_query($this->dbConnect, $query1);
		if (!$result1) {
			$error = " Error select employee numRows: ".$this->dbConnect->error;
			echo json_encode($error);
		}

		$numRows = mysqli_num_rows($result1);
		
		$dataTable = array();	
		while( $data = mysqli_fetch_assoc($result) ) {		
			$dataRows = array();			
			$dataRows[] = $data['id'];
			$dataRows[] = '<a class="btn btn-sm btn-info edt-btn-admin"><i class="fa fa-edit"></i></a>
						<a class="btn btn-sm btn-danger del-btn-admin"><i class="fa fa-trash"></i></a>';
			// $dataRows[] = $data['company_name'];
			$dataRows[] = $data['firstname'];
			$dataRows[] = $data['lastname'];
			$dataRows[] = $data['job_title'];
			$dataRows[] = $data['phone'];
			$dataRows[] = $data['facebook'];
			$dataRows[] = $data['instagram'];
			$dataRows[] = $data['twitter'];
			$dataRows[] = $data['description'];
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
			'companynameErr'=> '',
			'firstnameErr' 	=> '',
			'lastnameErr'	=> '',
			'jobErr' 		=> '',
			'phoneErr' 		=> '',
			'facebookErr' 	=> '',
			'instagramErr' 	=> '',
			'twitterErr' 	=> '',
			'descriptionErr'=> ''
		);

		// $companyname= $_POST['companyname'];
		$firstname 	= $_POST['firstname'];
		$lastname 	= $_POST['lastname'];
		$job	 	= $_POST['job'];
        $phone 		= $_POST['phone'];
        $facebook 	= $_POST['facebook'];
        $instagram 	= $_POST['instagram'];
		$twitter 	= $_POST['twitter'];
		$description= $_POST['description'];

		// if (empty($companyname) || trim($companyname) == "") {
		// 	$error['companynameErr'] = " Company name is required.";
		// 	$error['error'] = "error";
		// }
		// if (strlen($companyname) > 100) {
		// 	$error['companynameErr'] = " Invalid company name! Limited to 100 characters";
		// 	$error['error'] = "error";
		// }

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

		if (empty($job) || trim($job) == "") {
			$error['jobErr'] = " Job is required.";
			$error['error'] = "error";
		}
		if (strlen($job) > 100) {
			$error['jobErr'] = " Invalid job! Limited to 100 characters";
			$error['error'] = "error";
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

		if (strlen($facebook) > 200) {
			$error['facebookErr'] = " Invalid facebook! Limited to 200 characters";
			$error['error'] = "error";
		}
		if (strlen($instagram) > 200) {
			$error['instagramErr'] = " Invalid instagram! Limited to 200 characters";
			$error['error'] = "error";
		}
		if (strlen($twitter) > 200) {
			$error['twitterErr'] = " Invalid twitter! Limited to 200 characters";
			$error['error'] = "error";
		}
		if (strlen($description) > 500) {
			$error['descriptionErr'] = " Invalid facebook! Limited to 500 characters";
			$error['error'] = "error";
		}

		if ($error['error'] == "success") {
			$query = "INSERT INTO ".$this->dbTable." 
										(id, 
										firstname, 
										lastname, 
										job_title, 
										phone, 
										facebook, 
										instagram, 
										twitter, 
										description, 
										is_deleted, 
										created_date,  
										updated_date) 
							VALUES 		(NULL, 
										'$firstname', 
										'$lastname', 
										'$job', 
										'$phone', 
										'$facebook', 
										'$instagram', 
										'$twitter', 
										'$description', 
										'0', 
										now(), 
										NULL) ";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query insert employ: ".$this->dbConnect->error;
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
			'companynameErr'=> '',
			'firstnameErr' 	=> '',
			'lastnameErr'	=> '',
			'jobErr' 		=> '',
			'phoneErr' 		=> '',
			'facebookErr' 	=> '',
			'instagramErr' 	=> '',
			'twitterErr' 	=> '',
			'descriptionErr'=> ''
		);

		$id 		= $_POST['id'];
		// $companyname= $_POST['companyname'];
		$firstname 	= $_POST['firstname'];
		$lastname 	= $_POST['lastname'];
		$job	 	= $_POST['job'];
        $phone 		= $_POST['phone'];
        $facebook 	= $_POST['facebook'];
        $instagram 	= $_POST['instagram'];
		$twitter 	= $_POST['twitter'];
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
					$error['idErr'] = " Employ ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist ID: ".$this->dbConnect->error;
			}
		}
		
		// if (empty($companyname) || trim($companyname) == "") {
		// 	$error['companynameErr'] = " Company name is required.";
		// 	$error['error'] = "error";
		// }
		// if (strlen($companyname) > 100) {
		// 	$error['companynameErr'] = " Invalid company name! Limited to 100 characters";
		// 	$error['error'] = "error";
		// }

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

		if (empty($job) || trim($job) == "") {
			$error['jobErr'] = " Job is required.";
			$error['error'] = "error";
		}
		if (strlen($job) > 100) {
			$error['jobErr'] = " Invalid job! Limited to 100 characters";
			$error['error'] = "error";
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

		if (strlen($facebook) > 200) {
			$error['facebookErr'] = " Invalid facebook! Limited to 200 characters";
			$error['error'] = "error";
		}
		if (strlen($instagram) > 200) {
			$error['instagramErr'] = " Invalid instagram! Limited to 200 characters";
			$error['error'] = "error";
		}
		if (strlen($twitter) > 200) {
			$error['twitterErr'] = " Invalid twitter! Limited to 200 characters";
			$error['error'] = "error";
		}
		if (strlen($description) > 500) {
			$error['descriptionErr'] = " Invalid facebook! Limited to 500 characters";
			$error['error'] = "error";
		}

		if ($error['error'] == "success") {
			$query = "UPDATE ".$this->dbTable." SET     firstname   = '$firstname',
														lastname    = '$lastname',
														job_title   = '$job',
														phone       = '$phone',
														facebook    = '$facebook',
														instagram   = '$instagram',
														twitter     = '$twitter',
														description = '$description',
														updated_date= now()
												WHERE   id          = '$id'
												AND  	is_deleted  = '0'";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query update employee: ".$this->dbConnect->error;
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
			'companynameErr'=> '',
			'firstnameErr' 	=> '',
			'lastnameErr'	=> '',
			'jobErr' 		=> '',
			'phoneErr' 		=> '',
			'facebookErr' 	=> '',
			'instagramErr' 	=> '',
			'twitterErr' 	=> '',
			'descriptionErr'=> ''
		);

		$id 		= $_POST['id'];
		// $companyname= $_POST['companyname'];
		$firstname 	= $_POST['firstname'];
		$lastname 	= $_POST['lastname'];
		$job	 	= $_POST['job'];
        $phone 		= $_POST['phone'];
        $facebook 	= $_POST['facebook'];
        $instagram 	= $_POST['instagram'];
		$twitter 	= $_POST['twitter'];
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
					$error['idErr'] = " Employee ID not exist!";
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
				$error['queryErr'] = " Error query update to delete employee: ".$this->dbConnect->error;
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