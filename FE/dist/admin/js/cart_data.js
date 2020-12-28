$(document).ready(function(){	
	$("#carts").attr("class", "active");

	var dataTable = $('#table-admin').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"pagingType": "full_numbers",
		language: {
			search: "_INPUT_",
			searchPlaceholder: "Search Carts"
		},
		responsive: true,
		"pageLength": 10,
		"order":[],
		"ajax":{
			url:"../controller/cart_ctrl.php",
			type:"POST",
			data:{action:'listData'},
			dataType:"json"
		}
	});

	$('#addData').click(function(){
		$('#addModal').modal('show');
		$('#add_action').val('addData');
		$('#total_price').val('0.00');
		$('#total_quantity').val('0');
	});
	$("#addModal").on('submit','#addForm', function(event){
		event.preventDefault();
		$('#add_save').attr('disabled','disabled');
		$('#user_idErr').text("*");
		$('#total_priceErr').text("*");
		$('#total_quantityErr').text("*");
		
		// Check client input
		var errClient = false;
		if (($('#user_id').val()).trim() == "") {
			$('#user_idErr').text("* User ID is required.");
			errClient = true;
		}
		else if (!validateID($('#user_id').val())) {
			$('#user_idErr').text("* Invalid User ID format!");
			errClient = true;
		}

		// if (($('#total_price').val()).trim() == "") {
		// 	$('#total_priceErr').text("* Total price is required.");
		// 	errClient = true;
		// }
		// else if (!validatePrice($('#total_price').val())) {
		// 	$('#total_priceErr').text("* Invalid total price format! Input values ​​are accurate to 1-2 decimal places.");
		// 	errClient = true;
		// }

		// if (($('#total_quantity').val()).trim() == "") {
		// 	$('#total_quantityErr').text("* Total quantity is required.");
		// 	errClient = true;
		// }
		// else if (!validateID($('#total_quantity').val()) || $('#total_quantity').val() < 0) {
		// 	$('#total_quantityErr').text("* Invalid Total quantity format!");
		// 	errClient = true;
		// }
		// end Check client input
		
		if (errClient == false) {
			var formData = $(this).serialize();
			$.ajax({
				url:"../controller/cart_ctrl.php",
				method:"POST",
				data:formData,
				dataType: "json",
				success:function(result){			
					if (!result.hasOwnProperty('error')){
						alert('Error handling service!');
					}
					
					if(result.user_idErr != ""){
						$('#user_idErr').text(result.user_idErr);
					}
					if(result.total_priceErr != ""){
						$('#total_priceErr').text(result.total_priceErr);
					}
					if(result.total_quantityErr != ""){
						$('#total_quantityErr').text(result.total_quantityErr);
					}
					
					if(result.error == "error"){
						alert("Add new cart failed!");
					}
					else if(result.error == "success"){
						$('#addForm')[0].reset();
						$('#addModal').modal('hide');
						dataTable.ajax.reload();
						alert("Add new cart success!");
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
			alert("Add new cart failed!");
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
		$('#id_edt').val(data[0]);
		$('#user_id_old').val(data[2]);
		$('#user_id_new').val(data[2]);
		$('#user_old').val(data[2]+". "+data[3]);
		$('#total_price_edt').val(data[4]);
		$('#total_quantity_edt').val(data[5]);
		$('#edt_action').val('updateData');
	});
	$("#edtModal").on('submit','#edtForm', function(event){
		event.preventDefault();
		$('#edt_save').attr('disabled','disabled');
		$('#id_edtErr').text("*");
		$('#user_id_oldErr').text("*");
		$('#user_id_newErr').text("*");
		$('#total_price_edtErr').text("*");
		$('#total_quantity_edtErr').text("*");

		// Check client input
		var errClient = false;

		if (($('#id_edt').val()).trim() == "") {
			$('#id_edtErr').text("* ID is required.");
			errClient = true;
		}
		else if (!validateID($('#id_edt').val())) {
			$('#id_edtErr').text("* Invalid ID format!");
			errClient = true;
		}

		if (($('#user_id_new').val()).trim() == "") {
			$('#user_id_newErr').text("* New User ID is required.");
			errClient = true;
		}
		else if (!validateID($('#user_id_new').val())) {
			$('#user_id_newErr').text("* Invalid New User ID format!");
			errClient = true;
		}

		// if (($('#total_price_edt').val()).trim() == "") {
		// 	$('#total_price_edtErr').text("* Total price is required.");
		// 	errClient = true;
		// }
		// else if (!validatePrice($('#total_price_edt').val())) {
		// 	$('#total_price_edtErr').text("* Invalid total price format! Input values ​​are accurate to 1-2 decimal places.");
		// 	errClient = true;
		// }

		// if (($('#total_quantity_edt').val()).trim() == "") {
		// 	$('#total_quantity_edtErr').text("* Total quantity is required.");
		// 	errClient = true;
		// }
		// else if (!validateID($('#total_quantity_edt').val()) || $('#total_quantity_edt').val() < 0) {
		// 	$('#total_quantity_edtErr').text("* Invalid Total quantity format!");
		// 	errClient = true;
		// }
		
		// end Check client input

		if (errClient == false) {
			var formData = $(this).serialize();
			$.ajax({
				url:"../controller/cart_ctrl.php",
				method:"POST",
				data:formData,
				dataType: "json",
				success:function(result){			
					if (!result.hasOwnProperty('error')){
						alert('Error handling service!');
					}
					
					if(result.idErr != ""){
						$('#id_edtErr').text("*"+result.idErr);
					}
					if(result.user_id_newErr != ""){
						$('#user_id_newErr').text(result.user_id_newErr);
					}
					if(result.total_priceErr != ""){
						$('#total_price_edtErr').text(result.total_priceErr);
					}
					if(result.total_quantityErr != ""){
						$('#total_quantity_edtErr').text(result.total_quantityErr);
					}

					if(result.error == "error"){
						alert("Edit cart failed!");
					}
					else if(result.error == "success"){
						$('#edtForm')[0].reset();
						$('#edtModal').modal('hide');
						dataTable.ajax.reload();
						alert("Edit cart success!");
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
			alert("Edit cart failed!");
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
		$('#id_del').val(data[0]);
		$('#user_id_del').val(data[2]);
		$('#total_price_del').val(data[4]);
		$('#total_quantity_del').val(data[5]);
		$('#del_action').val('deleteData');
	});
	$("#delModal").on('submit','#delForm', function(event){
		event.preventDefault();
		$('#del_save').attr('disabled','disabled');
		$('#id_delErr').text("*");
		$('#user_id_delErr').text("*");
		$('#total_price_delErr').text("*");
		$('#total_quantity_delErr').text("*");

		// Check client input
		var errClient = false;
		if (($('#id_del').val()).trim() == "") {
			$('#id_delErr').text("* ID is required.");
			errClient = true;
		}
		else if (!validateID($('#id_del').val())) {
			$('#id_delErr').text("* Invalid ID format!");
			errClient = true;
		}

		if (errClient == false) {
			var formData = $(this).serialize();
			$.ajax({
				url:"../controller/cart_ctrl.php",
				method:"POST",
				data:formData,
				dataType: "json",
				success:function(result){			
					if (!result.hasOwnProperty('error')){
						alert('Error handling service!');
					}
					
					if(result.idErr != ""){
						$('#id_delErr').text("*"+result.idErr);
					}
					if(result.user_idErr != ""){
						$('#user_id_delErr').text(result.user_idErr);
					}
					if(result.total_priceErr != ""){
						$('#total_price_delErr').text(result.total_priceErr);
					}
					if(result.total_quantityErr != ""){
						$('#total_quantity_delErr').text(result.total_quantityErr);
					}

					if(result.error == "error"){
						alert("Delete cart failed!");
					}
					else if(result.error == "success"){
						$('#delForm')[0].reset();
						$('#delModal').modal('hide');
						dataTable.ajax.reload();
						alert("Delete cart success!");
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
			alert("Delete cart failed!");
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
function validatePrice(price) { 
	var letters = /^[-+]?[0-9]+\.[0-9]+$/;
	if(price.match(letters))
		return true;
	else
		return false;
}