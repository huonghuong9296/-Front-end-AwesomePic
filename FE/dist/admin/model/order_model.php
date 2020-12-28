<?php
require('config.php');
class Data extends Dbconfig {	
    protected $hostName;
    protected $userName;
    protected $password;
	protected $dbName;
	private $dbTable = 'orders';
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
		
		$query = "SELECT		a.id				id,
								b.id				user_id,
								b.username			username,
								a.total_price		total_price,
								a.currency			currency,
								a.total_quantity	total_quantity,
								a.is_paid			is_paid,
								a.created_date		created_date,
								a.updated_date		updated_date
					FROM		".$this->dbTable."	a,
								users				b 		
					WHERE 		a.is_deleted 	= '0'
					AND			a.user_id		= b.id
					";
		if(!empty($_POST["search"]["value"])){
			$query .= ' AND (a.id LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR b.id LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR b.username LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR a.total_price LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR a.currency LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR a.total_quantity LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR a.is_paid LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR a.created_date LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR a.updated_date LIKE "%'.$_POST["search"]["value"].'%") ';			
		}
		
		$colArr = ['id', 'id', 'user_id', 'username', 'total_price', 'currency', 'total_quantity', 'is_paid', 'created_date', 'updated_date'];
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
			$error = " Error select order search: ".$this->dbConnect->error;
			echo json_encode($error);
		}
		
		$query1 = "SELECT * FROM ".$this->dbTable." WHERE is_deleted = '0' ";
		$result1 = mysqli_query($this->dbConnect, $query1);
		if (!$result1) {
			$error = " Error select order numRows: ".$this->dbConnect->error;
			echo json_encode($error);
		}

		$numRows = mysqli_num_rows($result1);
		
		$dataTable = array();	
		while( $data = mysqli_fetch_assoc($result) ) {		
			$dataRows = array();			
			$dataRows[] = $data['id'];
			$dataRows[] = '<a class="btn btn-sm btn-info edt-btn-admin"><i class="fa fa-edit"></i></a>
						   <a class="btn btn-sm btn-danger del-btn-admin"><i class="fa fa-trash"></i></a>';
			$dataRows[] = $data['user_id'];
			$dataRows[] = $data['username'];
			$dataRows[] = $data['total_price'];
			$dataRows[] = $data['currency'];
			$dataRows[] = $data['total_quantity'];
			if ($data['is_paid'] == 1) {
				$dataRows[] = 'Paid';
			}
			else {
				$dataRows[] = 'Unpaid';
			}
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
			'error' 			=> 'success',
			'queryErr'			=> '',
			'idErr'				=> '',
			'user_idErr' 		=> '',
			'total_priceErr'	=> '',
			'currencyErr' 		=> '',
			'total_quantityErr'	=> '',
			'is_paidErr'		=> ''
		);

		$user_id 		= $_POST['user_id'];
		$total_price 	= $_POST['total_price'];
		$currency 		= $_POST['currency'];
		$total_quantity = $_POST['total_quantity'];
		$is_paid		= $_POST['is_paid'];

		if (empty($user_id) || trim($user_id) == "") {
			$error['user_idErr'] = "* User ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $user_id)) {
			$error['user_idErr'] = "* Invalid User ID format!";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	users
							WHERE 	id   		= '$user_id'
							AND  	is_deleted 	= '0'";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] == 0) {
					$error['user_idErr'] = "* User ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist User ID: ".$this->dbConnect->error;
			}
		}

		// if (empty($total_price) || trim($total_price) == "") {
		// 	$error['total_priceErr'] = "* Total price is required.";
		// 	$error['error'] = "error";
		// }
		// else if (!preg_match("/^[-+]?[0-9]+\.[0-9]+$/",$total_price)) {
		// 	$error['total_priceErr'] = "* Invalid total price format! Input values ​​are accurate to 1-2 decimal places.";
		// 	$error['error'] = "error";
		// }
		// else if ($total_price >= 10000000000000) {
		// 	$error['total_priceErr'] = " Invalid total price format! Limited to 13 whole digits.";
		// 	$error['error'] = "error";
		// }

		if (empty($currency) || trim($currency) == "") {
			$error['currencyErr'] = "* Currency is required.";
			$error['error'] = "error";
		}
		else if (strlen($currency) > 20) {
			$error['currencyErr'] = "* Invalid currency! Limited to 20 characters";
			$error['error'] = "error";
		}

		// if (empty($total_quantity) || trim($total_quantity) == "") {
		// 	$error['total_quantityErr'] = "* Total quantity is required.";
		// 	$error['error'] = "error";
		// }
		// else if (!preg_match("/^[0-9]*$/", $total_quantity) || $total_quantity < 0) {
		// 	$error['total_quantityErr'] = "* Invalid total quantity format!";
		// 	$error['error'] = "error";
		// }
		// else if ($total_quantity > 2000000000) {
		// 	$error['total_quantityErr'] = "* Invalid total quantity format! Limited to 2,000,000,000";
		// 	$error['error'] = "error";
		// }

		if ($is_paid != 1 && $is_paid != 0) {
			$error['is_paidErr'] = "* Invalid Payment Status format!";
			$error['error'] = "error";
		}

		if ($error['error'] == "success") {
			$query = "INSERT INTO ".$this->dbTable." 
										(id, 
										user_id, 
										total_price,
										currency,
										total_quantity,
										is_paid, 
										is_deleted, 
										created_date, 
										updated_date) 
							VALUES 		(NULL,
										'$user_id',
										'0',
										'$currency',
										'0',
										'$is_paid',
										'0',
										now(),
										NULL)";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query insert orders: ".$this->dbConnect->error;
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
			'idErr'				=> '',
			'user_id_newErr' 	=> '',
			'total_priceErr'	=> '',
			'currencyErr' 		=> '',
			'total_quantityErr'	=> '',
			'is_paidErr'		=> ''
		);

		$id 			= $_POST['id'];
		$user_id 		= $_POST['user_id_new'];
		$total_price 	= $_POST['total_price'];
		$currency 		= $_POST['currency'];
		$total_quantity = $_POST['total_quantity'];
		$is_paid		= $_POST['is_paid'];

		if (empty($id) || trim($id) == "") {
			$error['idErr'] = "* ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $id)) {
			$error['idErr'] = "* Invalid ID format!";
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
					$error['idErr'] = "* Order ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = "* Error query check exist ID: ".$this->dbConnect->error;
			}
		}

		if (empty($user_id) || trim($user_id) == "") {
			$error['user_id_newErr'] = "* User ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $user_id)) {
			$error['user_id_newErr'] = "* Invalid User ID format!";
			$error['error'] = "error";
		}
		else {
			$query_check =  "SELECT count(1) 
							FROM 	users
							WHERE 	id   		= '$user_id'
							AND  	is_deleted 	= '0'";
			$query_check_run = mysqli_query($this->dbConnect, $query_check);
			if ($query_check_run)
			{
				$data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
				if($data_check[0] == 0) {
					$error['user_id_newErr'] = "* User ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = " Error query check exist User ID: ".$this->dbConnect->error;
			}
		}

		// if (empty($total_price) || trim($total_price) == "") {
		// 	$error['total_priceErr'] = "* Total price is required.";
		// 	$error['error'] = "error";
		// }
		// else if (!preg_match("/^[-+]?[0-9]+\.[0-9]+$/",$total_price)) {
		// 	$error['total_priceErr'] = "* Invalid total price format! Input values ​​are accurate to 1-2 decimal places.";
		// 	$error['error'] = "error";
		// }
		// else if ($total_price >= 10000000000000) {
		// 	$error['total_priceErr'] = " Invalid total price format! Limited to 13 whole digits.";
		// 	$error['error'] = "error";
		// }

		if (empty($currency) || trim($currency) == "") {
			$error['currencyErr'] = "* Currency is required.";
			$error['error'] = "error";
		}
		else if (strlen($currency) > 20) {
			$error['currencyErr'] = "* Invalid currency! Limited to 20 characters";
			$error['error'] = "error";
		}

		// if (empty($total_quantity) || trim($total_quantity) == "") {
		// 	$error['total_quantityErr'] = "* Total quantity is required.";
		// 	$error['error'] = "error";
		// }
		// else if (!preg_match("/^[0-9]*$/", $total_quantity) || $total_quantity < 0) {
		// 	$error['total_quantityErr'] = "* Invalid total quantity format!";
		// 	$error['error'] = "error";
		// }
		// else if ($total_quantity > 2000000000) {
		// 	$error['total_quantityErr'] = "* Invalid total quantity format! Limited to 2,000,000,000";
		// 	$error['error'] = "error";
		// }

		if ($is_paid != 1 && $is_paid != 0) {
			$error['is_paidErr'] = "* Invalid Payment Status format!";
			$error['error'] = "error";
		}

		if ($error['error'] == "success") {
			$query = "UPDATE ".$this->dbTable." SET 	user_id   		= '$user_id',
														currency   		= '$currency',
														is_paid			= '$is_paid',
														updated_date	= now()
												WHERE   id          = '$id'
												AND  	is_deleted  = '0'";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query update order: ".$this->dbConnect->error;
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
			'idErr'				=> '',
			'user_idErr' 	=> '',
			'total_priceErr'	=> '',
			'currencyErr' 		=> '',
			'total_quantityErr'	=> '',
			'is_paidErr'		=> ''
		);

		$id 			= $_POST['id'];
		$user_id 		= $_POST['user_id'];
		$total_price 	= $_POST['total_price'];
		$currency 		= $_POST['currency'];
		$total_quantity = $_POST['total_quantity'];
		$is_paid		= $_POST['is_paid'];

		if (empty($id) || trim($id) == "") {
			$error['idErr'] = "* ID is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]*$/", $id)) {
			$error['idErr'] = "* Invalid ID format!";
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
					$error['idErr'] = "* Order ID not exist!";
					$error['error'] = "error";
				}
			}
			else
			{   
				$error['error'] = "error";
				$error['queryErr'] = "* Error query check exist ID: ".$this->dbConnect->error;
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

			$query =    "DELETE FROM 	order_detail
								WHERE 	order_id 	= '$id' 
								";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query delete order detail: ".$this->dbConnect->error;
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