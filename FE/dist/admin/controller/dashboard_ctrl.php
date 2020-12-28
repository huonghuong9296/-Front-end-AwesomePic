<?php
	include('../model/dashboard_model.php');
	$data = new Data();
	if(!empty($_POST['action']) && $_POST['action'] == 'dashboardInfo') {
		$data->dashboardInfo();
	}
	if(!empty($_POST['action']) && $_POST['action'] == 'updateCompanyInfo') {
		$data->updateCompanyInfo();
	}
?>