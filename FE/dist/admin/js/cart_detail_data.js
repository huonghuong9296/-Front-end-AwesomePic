$(document).ready(function(){	
	$("#cart-details").attr("class", "active");

	var dataTable = $('#table-admin').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"pagingType": "full_numbers",
		language: {
			search: "_INPUT_",
			searchPlaceholder: "Search Cart Detail"
		},
		responsive: true,
		"pageLength": 10,
		"order":[],
		"ajax":{
			url:"../controller/cart_detail_ctrl.php",
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
		$('#cart_idErr').text("*");
		$('#product_idErr').text("*");
		$('#quantityErr').text("*");
		
		// Check client input
		var errClient = false;
		if (($('#cart_id').val()).trim() == "") {
			$('#cart_idErr').text("* Cart ID is required.");
			errClient = true;
		}
		else if (!validateID($('#cart_id').val())) {
			$('#cart_idErr').text("* Invalid Cart ID format!");
			errClient = true;
		}

		if (($('#product_id').val()).trim() == "") {
			$('#product_idErr').text("* Product ID is required.");
			errClient = true;
		}
		else if (!validateID($('#product_id').val())) {
			$('#product_idErr').text("* Invalid Product ID format!");
			errClient = true;
		}

		if (($('#quantity').val()).trim() == "") {
			$('#quantityErr').text("* Quantity is required.");
			errClient = true;
		}
		else if (!validateID($('#quantity').val()) || $('#quantity').val() < 0) {
			$('#quantityErr').text("* Invalid Quantity format!");
			errClient = true;
		}
		// end Check client input
		
		if (errClient == false) {
			var formData = $(this).serialize();
			$.ajax({
				url:"../controller/cart_detail_ctrl.php",
				method:"POST",
				data:formData,
				dataType: "json",
				success:function(result){			
					if (!result.hasOwnProperty('error')){
						alert('Error handling service!');
					}
					
					if(result.cart_idErr != ""){
						$('#cart_idErr').text(result.cart_idErr);
					}
					if(result.product_idErr != ""){
						$('#product_idErr').text(result.product_idErr);
					}
					if(result.quantityErr != ""){
						$('#quantityErr').text(result.quantityErr);
					}
					
					if(result.error == "error"){
						alert("Add new cart detail failed!");
					}
					else if(result.error == "success"){
						$('#addForm')[0].reset();
						$('#addModal').modal('hide');
						dataTable.ajax.reload();
						alert("Add new cart detail success!");
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
			alert("Add new cart detail failed!");
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
		$('#cart_id_old').val(data[1]);
		$('#cart_old').val(data[1]+". "+data[2]);
		$('#cart_id_new').val(data[1]);
		$('#product_id_old').val(data[3]);
		$('#product_old').val(data[3]+". "+data[4]);
		$('#product_id_new').val(data[3]);
		$('#quantity_edt').val(data[6]);
		$('#edt_action').val('updateData');
	});
	$("#edtModal").on('submit','#edtForm', function(event){
		event.preventDefault();
		$('#edt_save').attr('disabled','disabled');
		$('#cart_id_oldErr').text("*");
		$('#cart_id_newErr').text("*");
		$('#product_id_oldErr').text("*");
		$('#product_id_newErr').text("*");
		$('#quantity_edtErr').text("*");

		// Check client input
		var errClient = false;

		if (($('#cart_id_old').val()).trim() == "") {
			$('#cart_id_oldErr').text("* Old cart ID is required.");
			errClient = true;
		}
		else if (!validateID($('#cart_id_old').val())) {
			$('#cart_id_oldErr').text("* Invalid Old cart ID format!");
			errClient = true;
		}
		
		if (($('#product_id_old').val()).trim() == "") {
			$('#product_id_oldErr').text("* Old Product ID is required.");
			errClient = true;
		}
		else if (!validateID($('#product_id_old').val())) {
			$('#product_id_oldErr').text("* Invalid Old Product ID format!");
			errClient = true;
		}

		if (($('#quantity_edt').val()).trim() == "") {
			$('#quantity_edtErr').text("* Quantity is required.");
			errClient = true;
		}
		else if (!validateID($('#quantity_edt').val()) || $('#quantity_edt').val() < 0) {
			$('#quantity_edtErr').text("* Invalid Quantity format!");
			errClient = true;
		}
		// end Check client input

		if (errClient == false) {
			var formData = $(this).serialize();
			$.ajax({
				url:"../controller/cart_detail_ctrl.php",
				method:"POST",
				data:formData,
				dataType: "json",
				success:function(result){			
					if (!result.hasOwnProperty('error')){
						alert('Error handling service!');
					}
					
					if(result.product_id_oldErr != ""){
						$('#product_id_oldErr').text(result.product_id_oldErr);
					}
					if(result.cart_id_oldErr != ""){
						$('#cart_id_oldErr').text(result.cart_id_oldErr);
					}
					if(result.product_id_newErr != ""){
						$('#product_id_newErr').text(result.product_id_newErr);
					}
					if(result.cart_id_newErr != ""){
						$('#cart_id_newErr').text(result.cart_id_newErr);
					}
					if(result.quantityErr != ""){
						$('#quantity_edtErr').text(result.quantityErr);
					}

					if(result.error == "error"){
						alert("Edit cart detail failed!");
					}
					else if(result.error == "success"){
						$('#edtForm')[0].reset();
						$('#edtModal').modal('hide');
						dataTable.ajax.reload();
						alert("Edit cart detail success!");
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
			alert("Edit cart detail failed!");
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
		$('#cart_id_del').val(data[1]);
		$('#cart_del').val(data[1]+". "+data[2]);
		$('#product_id_del').val(data[3]);
		$('#product_del').val(data[3]+". "+data[4]);
		$('#total_price_del').val(data[5]);
		$('#quantity_del').val(data[6]);
		$('#del_action').val('deleteData');
	});
	$("#delModal").on('submit','#delForm', function(event){
		event.preventDefault();
		$('#del_save').attr('disabled','disabled');
		$('#cart_id_delErr').text("*");
		$('#product_id_edlErr').text("*");
		$('#total_price_delErr').text("*");
		$('#quantity_delErr').text("*");
		
		// Check client input
		var errClient = false;

		if (($('#cart_id_del').val()).trim() == "") {
			$('#cart_id_delErr').text("* Cart ID is required.");
			errClient = true;
		}
		else if (!validateID($('#cart_id_del').val())) {
			$('#cart_id_delErr').text("* Invalid cart ID format!");
			errClient = true;
		}

		if (($('#product_id_del').val()).trim() == "") {
			$('#product_id_delErr').text("* Product ID is required.");
			errClient = true;
		}
		else if (!validateID($('#product_id_del').val())) {
			$('#product_id_delErr').text("* Invalid Product ID format!");
			errClient = true;
		}

		// if (($('#quantity_del').val()).trim() == "") {
		// 	$('#quantity_delErr').text("* Quantity is required.");
		// 	errClient = true;
		// }
		// else if (!validateID($('#quantity_del').val()) || $('#quantity_del').val() < 0) {
		// 	$('#quantity_delErr').text("* Invalid Quantity format!");
		// 	errClient = true;
		// }

		if (errClient == false) {
			var formData = $(this).serialize();
			$.ajax({
				url:"../controller/cart_detail_ctrl.php",
				method:"POST",
				data:formData,
				dataType: "json",
				success:function(result){			
					if (!result.hasOwnProperty('error')){
						alert('Error handling service!');
					}
					
					if(result.or_idErr != ""){
						$('#order_id_delErr').text(result.order_idErr);
					}
					if(result.product_idErr != ""){
						$('#product_id_delErr').text(result.product_idErr);
					}
					if(result.quantityErr != ""){
						$('#quantity_delErr').text(result.quantityErr);
					}

					if(result.error == "error"){
						alert("Delete cart detail failed!");
					}
					else if(result.error == "success"){
						$('#delForm')[0].reset();
						$('#delModal').modal('hide');
						dataTable.ajax.reload();
						alert("Delete cart detail success!");
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
			alert("Delete cart detail failed!");
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