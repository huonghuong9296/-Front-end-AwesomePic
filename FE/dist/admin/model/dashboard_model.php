<?php
require('config.php');
class Data extends Dbconfig {	
    protected $hostName;
    protected $userName;
    protected $password;
	protected $dbName;
	private $dbTable = 'carts';
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

	public function dashboardInfo(){		
		
		$error = array(
			'error' 			=> 'success',
			'queryErr'			=> '',
			'desErr'			=> ''
		);
		$company_info = array(
			'name	' 			=> '',
			'phone'				=> '',
			'email'				=> '',
			'address'			=> '',
			'city'				=> '',
			'country'			=> '',
			'description'		=> '',
			'logo'				=> ''
		);

		$revenue_monthly = array();
		$total_users_month = array();

		$data = array(
			'revenue_month'				=> '',
			'total_order_month'			=> '',
			'total_quantity_sale_month'	=> '',
			'revenue_year'				=> '',
			'total_order_year'			=> '',
			'total_quantity_sale_year'	=> '',
			'total_price_unpaid'		=> '',
			'total_users'				=> '',
			'total_products'			=> '',
			'total_employees'			=> '',
			'revenue_monthly'			=> $revenue_monthly,
			'total_users_month'			=> $total_users_month,
			'company_info'				=> $company_info,
			'error'						=> $error
		);

		$data = $this->getOrderInfo_CurrentMonth($data);
		$data = $this->getOrderInfo_CurrentYear($data);
		$data = $this->get_TotalUsers($data);
		$data = $this->getRevenue_Monthly($data);
		$data = $this->get_TotalProducts($data);
		$data = $this->get_TotalEmployees($data);
		$data = $this->getTotalUsers_Month($data);
		$data = $this->getCompany_Info($data);

		echo json_encode($data);
	}

	public function updateCompanyInfo(){
		$error = array(
			'error' 		=> 'success',
			'queryErr'		=> '',
			'nameErr' 		=> '',
			'emailErr' 		=> '',
			'phoneErr' 		=> '',
			'addressErr' 	=> '',
			'cityErr' 		=> '',
			'countryErr' 	=> '',
			'descriptionErr'=> '',
			'logoErr' 		=> ''
		);
		
        $name 		= $_POST['name'];
        $email 		= $_POST['email'];
        $phone 		= $_POST['phone'];
        $address 	= $_POST['address'];
        $city 		= $_POST['city'];
		$country 	= $_POST['country'];
		$description= $_POST['description'];
		$logo 		= $_POST['logo'];
		
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

		if (empty($phone) || trim($phone) == "") {
			$error['phoneErr'] = " Phone is required.";
			$error['error'] = "error";
		}
		else if (!preg_match("/^[0-9]{6,12}$/", $phone)) {
			$error['phoneErr'] = " Invalid phone format! From 6-12 numbers.";
			$error['error'] = "error";
		}
		
		if (empty($address) || trim($address) == "") {
			$error['addressErr'] = " Address is required.";
			$error['error'] = "error";
		}
		else if (strlen($address) > 100) {
			$error['addressErr'] = " Invalid address! Limited to 100 characters";
			$error['error'] = "error";
		}

		if (empty($city) || trim($city) == "") {
			$error['cityErr'] = " City is required.";
			$error['error'] = "error";
		}
		else if (strlen($city) > 32) {
			$error['cityErr'] = " Invalid city! Limited to 32 characters";
			$error['error'] = "error";
		}

		if (empty($country) || trim($country) == "") {
			$error['countryErr'] = " Country is required.";
			$error['error'] = "error";
		}
		else if (strlen($country) > 32) {
			$error['countryErr'] = " Invalid country! Limited to 32 characters";
			$error['error'] = "error";
		}

		if (strlen($description) > 1000) {
			$error['descriptionErr'] = " Invalid description! Limited to 1000 characters.";
			$error['error'] = "error";
		}

		if (empty($logo) || trim($logo) == "") {
			$error['logoErr'] = " Logo is required.";
			$error['error'] = "error";
		}

		if ($error['error'] == "success") {
			$query = "UPDATE company_info 		SET 	name   		= '$name',
														phone       = '$phone',
														email		= '$email',
														address     = '$address',
														city        = '$city',
														country     = '$country',
														description = '$description',
														logo     	= '$logo',
														updated_date= now()
												WHERE   1
												";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$error['error'] = "error";
				$error['queryErr'] = " Error query update company info: ".$this->dbConnect->error;
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

	private function getOrderInfo_CurrentMonth($data){
		$query = 	"SELECT sum(total_price) 	revenue_month
					FROM 	orders
					WHERE	is_deleted 	= '0'
					AND		month(created_date) = month(now()) 
					";
		$query_run = mysqli_query($this->dbConnect, $query);
		if (!$query_run) {
			$data['error']['error'] = "error";
			$data['error']['queryErr'] = " Error query get revenue_month: ".$this->dbConnect->error;
		}
		else {
			if ($query_run->num_rows == 1) {
				while($row = $query_run->fetch_assoc()) {
					$data['revenue_month'] 	= $row["revenue_month"];
				}
			}
			else if ($query_run->num_rows == 0) {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get revenue_month on orders: Not found.";
			}
			else {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get revenue_month on orders: Exception.";
			}

			if($data['revenue_month'] == null) {
				$data['revenue_month'] = 0;
			}
		}

		$query = 	"SELECT count(*) 	total_order_month
					FROM 	orders
					WHERE	is_deleted 	= '0'
					AND		month(created_date) = month(now()) 
					";
		$query_run = mysqli_query($this->dbConnect, $query);
		if (!$query_run) {
			$data['error']['error'] = "error";
			$data['error']['queryErr'] = " Error query get total_order_month: ".$this->dbConnect->error;
		}
		else {
			if ($query_run->num_rows == 1) {
				while($row = $query_run->fetch_assoc()) {
					$data['total_order_month'] 	= $row["total_order_month"];
				}
			}
			else if ($query_run->num_rows == 0) {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get total_order_month on orders: Not found.";
			}
			else {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get total_order_month on orders: Exception.";
			}

			if($data['total_order_month'] == null) {
				$data['total_order_month'] = 0;
			}
		}

		$query = 	"SELECT sum(total_quantity) 	total_quantity_sale_month
					FROM 	orders
					WHERE	is_deleted 	= '0'
					AND		month(created_date) = month(now()) 
					";
		$query_run = mysqli_query($this->dbConnect, $query);
		if (!$query_run) {
			$data['error']['error'] = "error";
			$data['error']['queryErr'] = " Error query get total_quantity_sale_month: ".$this->dbConnect->error;
		}
		else {
			if ($query_run->num_rows == 1) {
				while($row = $query_run->fetch_assoc()) {
					$data['total_quantity_sale_month'] 	= $row["total_quantity_sale_month"];
				}
			}
			else if ($query_run->num_rows == 0) {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get total_quantity_sale_month on orders: Not found.";
			}
			else {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get total_quantity_sale_month on orders: Exception.";
			}

			if($data['total_quantity_sale_month'] == null) {
				$data['total_quantity_sale_month'] = 0;
			}
		}

		$query = 	"SELECT sum(total_price) 	total_price_unpaid
					FROM 	orders
					WHERE	is_deleted 	= '0'
					AND		is_paid		= '0'
					";
		$query_run = mysqli_query($this->dbConnect, $query);
		if (!$query_run) {
			$data['error']['error'] = "error";
			$data['error']['queryErr'] = " Error query get total_price_unpaid: ".$this->dbConnect->error;
		}
		else {
			if ($query_run->num_rows == 1) {
				while($row = $query_run->fetch_assoc()) {
					$data['total_price_unpaid'] 	= $row["total_price_unpaid"];
				}
			}
			else if ($query_run->num_rows == 0) {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get total_price_unpaid on orders: Not found.";
			}
			else {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get total_price_unpaid on orders: Exception.";
			}

			if($data['total_price_unpaid'] == null) {
				$data['total_price_unpaid'] = 0;
			}
		}

		return $data;
	}

	private function getOrderInfo_CurrentYear($data){
		$query = 	"SELECT sum(total_price) 	revenue_year
					FROM 	orders
					WHERE	is_deleted 	= '0'
					AND		is_paid		= '1'
					AND		year(created_date) = year(now()) 
					";
		$query_run = mysqli_query($this->dbConnect, $query);
		if (!$query_run) {
			$data['error']['error'] = "error";
			$data['error']['queryErr'] = " Error query get revenue_year: ".$this->dbConnect->error;
		}
		else {
			if ($query_run->num_rows == 1) {
				while($row = $query_run->fetch_assoc()) {
					$data['revenue_year'] 	= $row["revenue_year"];
				}
			}
			else if ($query_run->num_rows == 0) {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get revenue_year on orders: Not found.";
			}
			else {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get revenue_year on orders: Exception.";
			}

			if($data['revenue_year'] == null) {
				$data['revenue_year'] = 0;
			}
		}

		$query = 	"SELECT count(*) 	total_order_year
					FROM 	orders
					WHERE	is_deleted 	= '0'
					AND		year(created_date) = year(now()) 
					";
		$query_run = mysqli_query($this->dbConnect, $query);
		if (!$query_run) {
			$data['error']['error'] = "error";
			$data['error']['queryErr'] = " Error query get total_order_year: ".$this->dbConnect->error;
		}
		else {
			if ($query_run->num_rows == 1) {
				while($row = $query_run->fetch_assoc()) {
					$data['total_order_year'] 	= $row["total_order_year"];
				}
			}
			else if ($query_run->num_rows == 0) {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get total_order_year on orders: Not found.";
			}
			else {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get total_order_year on orders: Exception.";
			}

			if($data['total_order_year'] == null) {
				$data['total_order_year'] = 0;
			}
		}

		$query = 	"SELECT sum(total_quantity) 	total_quantity_sale_year
					FROM 	orders
					WHERE	is_deleted 	= '0'
					AND		year(created_date) = year(now()) 
					";
		$query_run = mysqli_query($this->dbConnect, $query);
		if (!$query_run) {
			$data['error']['error'] = "error";
			$data['error']['queryErr'] = " Error query get total_quantity_sale_year: ".$this->dbConnect->error;
		}
		else {
			if ($query_run->num_rows == 1) {
				while($row = $query_run->fetch_assoc()) {
					$data['total_quantity_sale_year'] 	= $row["total_quantity_sale_year"];
				}
			}
			else if ($query_run->num_rows == 0) {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get total_quantity_sale_year on orders: Not found.";
			}
			else {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get total_quantity_sale_year on orders: Exception.";
			}

			if($data['total_quantity_sale_year'] == null) {
				$data['total_quantity_sale_year'] = 0;
			}
		}

		return $data;
	}

	private function getRevenue_Monthly($data){
		for ($x = 1; $x <= 12; $x++) {
			$query = 	"SELECT sum(total_price) 	revenue_monthly
					FROM 	orders
					WHERE	is_deleted 			= '0'
					AND		month(created_date) = '$x'
					";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = " Error query revenue_monthly: ".$this->dbConnect->error;
			}
			else {
				if ($query_run->num_rows == 1) {
					while($row = $query_run->fetch_assoc()) {
						$data['revenue_monthly'][$x-1] = $row["revenue_monthly"];
					}
				}
				else if ($query_run->num_rows == 0) {
					$data['error']['error'] = "error";
					$data['error']['queryErr'] = "* Error revenue_monthly table orders: Not found.";
				}
				else {
					$data['error']['error'] = "error";
					$data['error']['queryErr'] = "* Error revenue_monthly table orders: Exception.";
				}
			}
			
			// if($data['revenue_monthly'][$x-1] == null) {
			// 	$data['revenue_monthly'][$x-1] = 0;
			// }
		}

		return $data;
	}

	private function getTotalUsers_Month($data){
		for ($x = 1; $x <= 6; $x++) {
			$y = 2*$x;
			$query = 	"SELECT count(*) 	total_users_month
					FROM 	users
					WHERE	is_deleted 			 = '0'
					AND		(month(created_date) = '$y'
					OR		month(created_date)  = '$y' - 1)
					AND		year(created_date)	 = year(now())
					";
			$query_run = mysqli_query($this->dbConnect, $query);
			if (!$query_run) {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = " Error query total_users_month: ".$this->dbConnect->error;
			}
			else {
				if ($query_run->num_rows == 1) {
					while($row = $query_run->fetch_assoc()) {
						$data['total_users_month'][$x-1] = $row["total_users_month"];
					}
				}
				else if ($query_run->num_rows == 0) {
					$data['error']['error'] = "error";
					$data['error']['queryErr'] = "* Error total_users_month table orders: Not found.";
				}
				else {
					$data['error']['error'] = "error";
					$data['error']['queryErr'] = "* Error total_users_month table orders: Exception.";
				}
			}
			
			// if($data['total_users_month'][$x-1] == null) {
			// 	$data['total_users_month'][$x-1] = 0;
			// }
		}

		return $data;
	}

	private function get_TotalUsers($data){
		$query = 	"SELECT count(*) 	total_users
					FROM 	users
					WHERE	is_deleted 	= '0'
					";
		$query_run = mysqli_query($this->dbConnect, $query);
		if (!$query_run) {
			$data['error']['error'] = "error";
			$data['error']['queryErr'] = " Error query get_TotalUsers: ".$this->dbConnect->error;
		}
		else {
			if ($query_run->num_rows == 1) {
				while($row = $query_run->fetch_assoc()) {
					$data['total_users'] = $row["total_users"];
				}
			}
			else if ($query_run->num_rows == 0) {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get_TotalUsers table users: Not found.";
			}
			else {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get_TotalUsers table users: Exception.";
			}

			if($data['total_users'] == null) {
				$data['total_users'] = 0;
			}
		}
		return $data;
	}

	private function get_TotalProducts($data){
		$query = 	"SELECT count(*) 	total_products
					FROM 	products
					WHERE	is_deleted 	= '0'
					";
		$query_run = mysqli_query($this->dbConnect, $query);
		if (!$query_run) {
			$data['error']['error'] = "error";
			$data['error']['queryErr'] = " Error query total_products: ".$this->dbConnect->error;
		}
		else {
			if ($query_run->num_rows == 1) {
				while($row = $query_run->fetch_assoc()) {
					$data['total_products'] = $row["total_products"];
				}
			}
			else if ($query_run->num_rows == 0) {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get total_products table products: Not found.";
			}
			else {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get total_products table products: Exception.";
			}

			if($data['total_products'] == null) {
				$data['total_products'] = 0;
			}
		}
		return $data;
	}

	private function get_TotalEmployees($data){
		$query = 	"SELECT count(*) 	total_employees
					FROM 	employees
					WHERE	is_deleted 	= '0'
					";
		$query_run = mysqli_query($this->dbConnect, $query);
		if (!$query_run) {
			$data['error']['error'] = "error";
			$data['error']['queryErr'] = " Error query total_employees: ".$this->dbConnect->error;
		}
		else {
			if ($query_run->num_rows == 1) {
				while($row = $query_run->fetch_assoc()) {
					$data['total_employees'] = $row["total_employees"];
				}
			}
			else if ($query_run->num_rows == 0) {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get total_employees table products: Not found.";
			}
			else {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get total_employees table products: Exception.";
			}

			if($data['total_employees'] == null) {
				$data['total_employees'] = 0;
			}
		}
		return $data;
	}

	private function getCompany_info($data){
		$query = 	"SELECT name,
							phone,
							email,
							address,
							city,
							country,
							description,
							logo
					FROM 	company_info
					LIMIT	1
					";
		$query_run = mysqli_query($this->dbConnect, $query);
		if (!$query_run) {
			$data['error']['error'] = "error";
			$data['error']['queryErr'] = " Error query getCompany_info: ".$this->dbConnect->error;
		}
		else {
			if ($query_run->num_rows == 1) {
				while($row = $query_run->fetch_assoc()) {
					$data['company_info']['name']		= $row["name"];
					$data['company_info']['phone']		= $row["phone"];
					$data['company_info']['email']		= $row["email"];
					$data['company_info']['address']	= $row["address"];
					$data['company_info']['city']		= $row["city"];
					$data['company_info']['country']	= $row["country"];
					$data['company_info']['description']= $row["description"];
					$data['company_info']['logo']		= $row["logo"];
				}
			}
			else if ($query_run->num_rows == 0) {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get getCompany_info table products: Not found.";
			}
			else {
				$data['error']['error'] = "error";
				$data['error']['queryErr'] = "* Error get getCompany_info table products: Exception.";
			}
		}
		return $data;
	}
}
?>