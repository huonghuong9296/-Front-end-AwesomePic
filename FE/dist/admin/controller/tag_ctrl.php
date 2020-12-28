<?php
	include('../model/tag_model.php');
	$data = new Data();
	if(!empty($_POST['action']) && $_POST['action'] == 'listData') {
		$data->dataList();
	}
	if(!empty($_POST['action']) && $_POST['action'] == 'addData') {
		$data->addData();
	}
	if(!empty($_POST['action']) && $_POST['action'] == 'getData') {
		$data->getItem();
	}
	if(!empty($_POST['action']) && $_POST['action'] == 'updateData') {
		$data->updateData();
	}
	if(!empty($_POST['action']) && $_POST['action'] == 'deleteData') {
		$data->deleteData();
	}
?>