$(document).ready(function(){	
	$("#product-categories").attr("class", "active");

	var dataTable = $('#table-admin').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"pagingType": "full_numbers",
		language: {
			search: "_INPUT_",
			searchPlaceholder: "Product Categories"
		},
		responsive: true,
		"pageLength": 10,
		"order":[],
		"ajax":{
			url:"../controller/product_category_ctrl.php",
			type:"POST",
			data:{action:'listData'},
			dataType:"json"
		}
	});

	$('#addData').click(function(){
		$('#addModal').modal('show');
		$('#add_action').val('addData');
	});
	$("#addModal").on('submit','#addForm', function(event){
		event.preventDefault();
		$('#add_save').attr('disabled','disabled');
		$('#product_idErr').text("*");
		$('#category_idErr').text("*");
		
		// Check client input
		var errClient = false;
		if (($('#product_id').val()).trim() == "") {
			$('#product_idErr').text("* Product ID is required.");
			errClient = true;
		}
		else if (!validateID($('#product_id').val())) {
			$('#product_idErr').text("* Invalid Product ID format!");
			errClient = true;
		}

		if (($('#category_id').val()).trim() == "") {
			$('#category_idErr').text("* Category ID is required.");
			errClient = true;
		}
		else if (!validateID($('#category_id').val())) {
			$('#category_idErr').text("* Invalid Category ID format!");
			errClient = true;
		}
		// end Check client input
		
		if (errClient == false) {
			var formData = $(this).serialize();
			$.ajax({
				url:"../controller/product_category_ctrl.php",
				method:"POST",
				data:formData,
				dataType: "json",
				success:function(result){			
					if (!result.hasOwnProperty('error')){
						alert('Error handling service!');
					}
					
					if(result.product_idErr != ""){
						$('#product_idErr').text("*"+result.product_idErr);
					}
					if(result.category_idErr != ""){
						$('#category_idErr').text("*"+result.category_idErr);
					}
					
					if(result.error == "error"){
						alert("Add new product category failed!");
					}
					else if(result.error == "success"){
						$('#addForm')[0].reset();
						$('#addModal').modal('hide');
						dataTable.ajax.reload();
						alert("Add new product category success!");
					}
					else {
						alert("Error handling service!");
					}
					
					if (result.queryErr != "") {
						alert("Error handling service!");
					}
				},
				error: function (e) {
					alert("Error response service!");
					console.log(e);
				}
			})
		}
		else {
			alert("Add new product category failed!");
		}
		$('#add_save').attr('disabled', false);
	});

	$("#table-admin").on('click', '.edt-btn-admin', function(){
		$('#edtModal').modal('show');
		$tr = $(this).closest('tr');
		var data = $tr.children("td").map(function() {
			return $(this).text();
		}).get();
		console.log(data);
		$('#product_id_old').val(data[1]);
		$('#product_old').val(data[1]+". "+data[2]);
		$('#category_id_old').val(data[3]);
		$('#category_old').val(data[3]+". "+data[4]);
		$('#edt_action').val('updateData');
	});
	$("#edtModal").on('submit','#edtForm', function(event){
		event.preventDefault();
		$('#edt_save').attr('disabled','disabled');
		$('#product_id_oldErr').text("*");
		$('#product_id_newErr').text("*");
		$('#category_id_oldErr').text("*");
		$('#category_id_newErr').text("*");

		// Check client input
		var errClient = false;
		if (($('#product_id_old').val()).trim() == "") {
			$('#product_id_oldErr').text("* Old Product ID is required.");
			errClient = true;
		}
		else if (!validateID($('#product_id_old').val())) {
			$('#product_id_oldErr').text("* Invalid Old Product ID format!");
			errClient = true;
		}

		if (($('#category_id_old').val()).trim() == "") {
			$('#category_id_oldErr').text("* Old Category ID is required.");
			errClient = true;
		}
		else if (!validateID($('#category_id_old').val())) {
			$('#category_id_oldErr').text("* Invalid Old Category ID format!");
			errClient = true;
		}

		if (($('#product_id_new').val()).trim() == "") {
			$('#product_id_newErr').text("* New Product ID is required.");
			errClient = true;
		}
		else if (!validateID($('#product_id_new').val())) {
			$('#product_id_newErr').text("* Invalid New Product ID format!");
			errClient = true;
		}

		if (($('#category_id_new').val()).trim() == "") {
			$('#category_id_newErr').text("* New Category ID is required.");
			errClient = true;
		}
		else if (!validateID($('#category_id_new').val())) {
			$('#category_id_newErr').text("* Invalid New Category ID format!");
			errClient = true;
		}
		// end Check client input

		if (errClient == false) {
			var formData = $(this).serialize();
			$.ajax({
				url:"../controller/product_category_ctrl.php",
				method:"POST",
				data:formData,
				dataType: "json",
				success:function(result){			
					if (!result.hasOwnProperty('error')){
						alert('Error handling service!');
					}
					
					if(result.product_id_oldErr != ""){
						$('#product_id_oldErr').text("*"+result.product_id_oldErr);
					}
					if(result.category_id_oldErr != ""){
						$('#category_id_oldErr').text("*"+result.category_id_oldErr);
					}
					if(result.product_id_newErr != ""){
						$('#product_id_newErr').text("*"+result.product_id_newErr);
					}
					if(result.category_id_newErr != ""){
						$('#category_id_newErr').text("*"+result.category_id_newErr);
					}

					if(result.error == "error"){
						alert("Edit product category failed!");
					}
					else if(result.error == "success"){
						$('#edtForm')[0].reset();
						$('#edtModal').modal('hide');
						dataTable.ajax.reload();
						alert("Edit product category success!");
					}
					else {
						alert("Error handling service!");
					}
					
					if (result.queryErr != "") {
						alert("Error handling service!");
					}
				},
				error: function (e) {
					alert("Error response service!");
					console.log(e);
				}
			})
		}
		else {
			alert("Edit product category failed!");
		}
		$('#edt_save').attr('disabled', false);
	});

	$("#table-admin").on('click', '.del-btn-admin', function(){
		$('#delModal').modal('show');
		$tr = $(this).closest('tr');
		var data = $tr.children("td").map(function() {
			return $(this).text();
		}).get();
		console.log(data);
		$('#product_id_del').val(data[1]);
		$('#product_del').val(data[1]+". "+data[2]);
		$('#category_id_del').val(data[3]);
		$('#category_del').val(data[3]+". "+data[4]);
		$('#del_action').val('deleteData');
	});
	$("#delModal").on('submit','#delForm', function(event){
		event.preventDefault();
		$('#del_save').attr('disabled','disabled');
		$('#product_id_edlErr').text("*");
		$('#category_id_delErr').text("*");

		// Check client input
		var errClient = false;
		if (($('#product_id_del').val()).trim() == "") {
			$('#product_id_delErr').text("* Product ID is required.");
			errClient = true;
		}
		else if (!validateID($('#product_id_del').val())) {
			$('#product_id_delErr').text("* Invalid Product ID format!");
			errClient = true;
		}

		if (($('#category_id_del').val()).trim() == "") {
			$('#category_id_delErr').text("* Category ID is required.");
			errClient = true;
		}
		else if (!validateID($('#category_id_del').val())) {
			$('#category_id_delErr').text("* Invalid Category ID format!");
			errClient = true;
		}

		if (errClient == false) {
			var formData = $(this).serialize();
			$.ajax({
				url:"../controller/product_category_ctrl.php",
				method:"POST",
				data:formData,
				dataType: "json",
				success:function(result){			
					if (!result.hasOwnProperty('error')){
						alert('Error handling service!');
					}
					
					if(result.product_idErr != ""){
						$('#product_id_delErr').text("*"+result.product_idErr);
					}
					if(result.category_idErr != ""){
						$('#category_id_delErr').text("*"+result.category_idErr);
					}

					if(result.error == "error"){
						alert("Delete product category failed!");
					}
					else if(result.error == "success"){
						$('#delForm')[0].reset();
						$('#delModal').modal('hide');
						dataTable.ajax.reload();
						alert("Delete product category success!");
					}
					else {
						alert("Error handling service!");
					}
					
					if (result.queryErr != "") {
						alert("Error handling service!");
					}
				},
				error: function (e) {
					alert("Error response service!" + e);
					console.log("AJAX ERROR: " + e);
				}
			})
		}
		else {
			alert("Delete product category failed!");
		}
		$('#del_save').attr('disabled', false);
	});

});

function validateID(id) { 
	var letters = /^[0-9]*$/;
	if(id.match(letters))
		return true;
	else
		return false;
}