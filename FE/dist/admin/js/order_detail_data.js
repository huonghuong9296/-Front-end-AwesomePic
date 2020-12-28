$(document).ready(function(){	
	$("#order-details").attr("class", "active");

	var dataTable = $('#table-admin').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"pagingType": "full_numbers",
		language: {
			search: "_INPUT_",
			searchPlaceholder: "Search Order Detail"
		},
		responsive: true,
		"pageLength": 10,
		"order":[],
		"ajax":{
			url:"../controller/order_detail_ctrl.php",
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
		$('#order_idErr').text("*");
		$('#product_idErr').text("*");
		$('#priceErr').text("*");
		$('#quantityErr').text("*");
		
		// Check client input
		var errClient = false;
		if (($('#order_id').val()).trim() == "") {
			$('#order_idErr').text("* Order ID is required.");
			errClient = true;
		}
		else if (!validateID($('#order_id').val())) {
			$('#order_idErr').text("* Invalid Order ID format!");
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

		if (($('#price').val()).trim() == "") {
			$('#priceErr').text("* Price is required.");
			errClient = true;
		}
		else if (!validatePrice($('#price').val())) {
			$('#priceErr').text("* Invalid Price format! Input values ​​are accurate to 1-2 decimal places.");
			errClient = true;
		}
		else if ($('#price').val() >= 10000000000000) {
			$error['#priceErr'] = " Invalid price format! Limited to 13 whole digits.";
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
		else if ($('#quantity').val() > 2000000000) {
			$('#quantityErr').text("* Invalid quantity format! Limited to 2,000,000,000");
			errClient = true;
		}
		// end Check client input
		
		if (errClient == false) {
			var formData = $(this).serialize();
			$.ajax({
				url:"../controller/order_detail_ctrl.php",
				method:"POST",
				data:formData,
				dataType: "json",
				success:function(result){			
					if (!result.hasOwnProperty('error')){
						alert('Error handling service!');
					}
					
					if(result.order_idErr != ""){
						$('#order_idErr').text(result.order_idErr);
					}
					if(result.product_idErr != ""){
						$('#product_idErr').text(result.product_idErr);
					}
					if(result.priceErr != ""){
						$('#priceErr').text(result.priceErr);
					}
					if(result.quantityErr != ""){
						$('#quantityErr').text(result.quantityErr);
					}
					
					if(result.error == "error"){
						alert("Add new order detail failed!");
					}
					else if(result.error == "success"){
						$('#addForm')[0].reset();
						$('#addModal').modal('hide');
						dataTable.ajax.reload();
						alert("Add new order detail success!");
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
			alert("Add new order detail failed!");
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
		$('#order_id_old').val(data[1]);
		$('#order_old').val(data[1]+". "+data[2]);
		$('#order_id_new').val(data[1]);
		$('#product_id_old').val(data[3]);
		$('#product_old').val(data[3]+". "+data[4]);
		$('#product_id_new').val(data[3]);
		$('#price_edt').val(data[7]);
		$('#quantity_edt').val(data[6]);
		$('#edt_action').val('updateData');
	});
	$("#edtModal").on('submit','#edtForm', function(event){
		event.preventDefault();
		$('#edt_save').attr('disabled','disabled');
		$('#order_id_oldErr').text("*");
		$('#order_id_newErr').text("*");
		$('#product_id_oldErr').text("*");
		$('#product_id_newErr').text("*");
		$('#price_edtErr').text("*");
		$('#quantity_edtErr').text("*");

		// Check client input
		var errClient = false;

		if (($('#order_id_old').val()).trim() == "") {
			$('#order_id_oldErr').text("* Old order ID is required.");
			errClient = true;
		}
		else if (!validateID($('#order_id_old').val())) {
			$('#order_id_oldErr').text("* Invalid Old order ID format!");
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

		if (($('#price_edt').val()).trim() == "") {
			$('#price_edtErr').text("* Price is required.");
			errClient = true;
		}
		else if (!validatePrice($('#price_edt').val())) {
			$('#price_edtErr').text("* Invalid price format! Input values ​​are accurate to 1-2 decimal places.");
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
				url:"../controller/order_detail_ctrl.php",
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
					if(result.order_id_oldErr != ""){
						$('#order_id_oldErr').text(result.order_id_oldErr);
					}
					if(result.product_id_newErr != ""){
						$('#product_id_newErr').text(result.product_id_newErr);
					}
					if(result.order_id_newErr != ""){
						$('#order_id_newErr').text(result.order_id_newErr);
					}
					if(result.priceErr != ""){
						$('#price_edtErr').text(result.priceErr);
					}
					if(result.quantityErr != ""){
						$('#quantity_edtErr').text(result.quantityErr);
					}

					if(result.error == "error"){
						alert("Edit order detail failed!");
					}
					else if(result.error == "success"){
						$('#edtForm')[0].reset();
						$('#edtModal').modal('hide');
						dataTable.ajax.reload();
						alert("Edit order detail success!");
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
			alert("Edit order detail failed!");
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
		$('#order_id_del').val(data[1]);
		$('#order_del').val(data[1]+". "+data[2]);
		$('#product_id_del').val(data[3]);
		$('#product_del').val(data[3]+". "+data[4]);
		$('#total_price_del').val(data[5]);
		$('#quantity_del').val(data[6]);
		$('#price_del').val(data[7]);
		$('#del_action').val('deleteData');
	});
	$("#delModal").on('submit','#delForm', function(event){
		event.preventDefault();
		$('#del_save').attr('disabled','disabled');
		$('#order_id_delErr').text("*");
		$('#product_id_edlErr').text("*");
		$('#price_delErr').text("*");
		$('#quantity_delErr').text("*");
		
		// Check client input
		var errClient = false;

		if (($('#order_id_del').val()).trim() == "") {
			$('#order_id_delErr').text("* Order ID is required.");
			errClient = true;
		}
		else if (!validateID($('#order_id_del').val())) {
			$('#order_id_delErr').text("* Invalid order ID format!");
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

		if (errClient == false) {
			var formData = $(this).serialize();
			$.ajax({
				url:"../controller/order_detail_ctrl.php",
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
					if(result.priceErr != ""){
						$('#price_delErr').text(result.priceErr);
					}
					if(result.quantityErr != ""){
						$('#quantity_delErr').text(result.quantityErr);
					}

					if(result.error == "error"){
						alert("Delete order detail failed!");
					}
					else if(result.error == "success"){
						$('#delForm')[0].reset();
						$('#delModal').modal('hide');
						dataTable.ajax.reload();
						alert("Delete order detail success!");
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
			alert("Delete order detail failed!");
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