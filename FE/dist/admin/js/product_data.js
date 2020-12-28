$(document).ready(function(){	
	$("#products").attr("class", "active");

	var dataTable = $('#table-admin').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"pagingType": "full_numbers",
		language: {
			search: "_INPUT_",
			searchPlaceholder: "Search Products"
		},
		responsive: true,
		"pageLength": 10,
		"order":[],
		"ajax":{
			url:"../controller/product_ctrl.php",
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
		$('#nameErr').text("*");
		$('#srcErr').text("*");
		$('#priceErr').text("*");
		$('#currencyErr').text("*");
		$('#descriptionErr').text("");
		
		// Check client input
		var errClient = false;
		if (($('#name').val()).trim() == "") {
			$('#nameErr').text("* Name is required.");
			errClient = true;
		}
		else if (!validateProductName($('#name').val())) {
			$('#nameErr').text("* Only letters, numbers and white space allowed. Limited to 50 characters.");
			errClient = true;
		}

		if (($('#src').val()).trim() == "") {
			$('#srcErr').text("* SRC is required.");
			errClient = true;
		}

		if (($('#price').val()).trim() == "") {
			$('#priceErr').text("* Price is required.");
			errClient = true;
		}
		else if (!validatePrice($('#price').val())) {
			$('#priceErr').text("* Invalid price format! Input values ​​are accurate to 1-2 decimal places.");
			errClient = true;
		}
		else if ($('#price').val() >= 10000000000000) {
			$('#priceErr').text("* Invalid price format! Limited to 13 whole digits.");
			errClient = true;
		}

		if (($('#currency').val()).trim() == "") {
			$('#currencyErr').text("* Currency is required.");
			errClient = true;
		}
		else if (($('#currency').val()).length > 20 ) {
			$('#currencyErr').text("* Invalid currency! Limited to 20 characters.");
			errClient = true;
		}

		if (($('#description').val()).length > 1000 ) {
			$('#descriptionErr').text(" Invalid description! Limited to 1000 characters.");
			errClient = true;
		}
		// end Check client input
		
		if (errClient == false) {
			var formData = $(this).serialize();
			$.ajax({
				url:"../controller/product_ctrl.php",
				method:"POST",
				data:formData,
				dataType: "json",
				success:function(result){			
					if (!result.hasOwnProperty('error')){
						alert('Error handling service!');
					}
					
					if(result.nameErr != ""){
						$('#nameErr').text("*"+result.nameErr);
					}
					if(result.srcErr != ""){
						$('#srcErr').text("*"+result.srcErr);
					}
					if(result.priceErr != ""){
						$('#priceErr').text("*"+result.priceErr);
					}
					if(result.currencyErr != ""){
						$('#currencyErr').text("*"+result.currencyErr);
					}
					if(result.descriptionErr != ""){
						$('#descriptionErr').text(result.descriptionErr);
					}
					
					if(result.error == "error"){
						alert("Add new product failed!");
					}
					else if(result.error == "success"){
						$('#addForm')[0].reset();
						$('#addModal').modal('hide');
						dataTable.ajax.reload();
						alert("Add new product success!");
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
			alert("Add new product failed!");
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
		$('#name_edt').val(data[3]);
		$('#src_edt').val(data[4]);
		$('#price_edt').val(data[5]);
		$('#currency_edt').val(data[6]);
		$('#description_edt').val(data[7]);
		$('#edt_action').val('updateData');
	});
	$("#edtModal").on('submit','#edtForm', function(event){
		event.preventDefault();
		$('#edt_save').attr('disabled','disabled');
		$('#id_edtErr').text("*");
		$('#name_edtErr').text("*");
		$('#src_edtErr').text("*");
		$('#price_edtErr').text("*");
		$('#currency_edtErr').text("*");
		$('#description_edtErr').text("");

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

		if (($('#name_edt').val()).trim() == "") {
			$('#name_edtErr').text("* Name is required.");
			errClient = true;
		}
		else if (!validateProductName($('#name_edt').val())) {
			$('#name_edtErr').text("* Only letters, numbers and white space allowed. Limited to 50 characters.");
			errClient = true;
		}

		if (($('#src_edt').val()).trim() == "") {
			$('#src_edtErr').text("* SRC is required.");
			errClient = true;
		}

		if (($('#price_edt').val()).trim() == "") {
			$('#price_edtErr').text("* Price is required.");
			errClient = true;
		}
		else if (!validatePrice($('#price_edt').val())) {
			$('#price_edtErr').text("* Invalid price format! Input values ​​are accurate 1-2 decimal places.");
			errClient = true;
		}
		else if ($('#price_edt').val() >= 10000000000000) {
			$('#price_edtErr').text("* Invalid price format! Limited to 13 whole digits.");
			errClient = true;
		}

		if (($('#currency_edt').val()).trim() == "") {
			$('#currency_edtErr').text("* Currency is required.");
			errClient = true;
		}
		else if (($('#currency_edt').val()).length > 20 ) {
			$('#currency_edtErr').text("* Invalid currency! Limited to 20 characters.");
			errClient = true;
		}

		if (($('#description_edt').val()).length > 1000 ) {
			$('#description_edtErr').text(" Invalid description! Limited to 1000 characters.");
			errClient = true;
		}
		// end Check client input

		if (errClient == false) {
			var formData = $(this).serialize();
			$.ajax({
				url:"../controller/product_ctrl.php",
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
					if(result.nameErr != ""){
						$('#name_edtErr').text("*"+result.nameErr);
					}
					if(result.srcErr != ""){
						$('#src_edtErr').text("*"+result.srcErr);
					}
					if(result.priceErr != ""){
						$('#price_edtErr').text("*"+result.priceErr);
					}
					if(result.currencyErr != ""){
						$('#currency_edtErr').text("*"+result.currencyErr);
					}
					if(result.descriptionErr != ""){
						$('#description_edtErr').text(result.descriptionErr);
					}

					if(result.error == "error"){
						alert("Edit product failed!");
					}
					else if(result.error == "success"){
						$('#edtForm')[0].reset();
						$('#edtModal').modal('hide');
						dataTable.ajax.reload();
						alert("Edit product success!");
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
			alert("Edit product failed!");
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
		$('#name_del').val(data[3]);
		$('#src_del').val(data[4]);
		$('#price_del').val(data[5]);
		$('#currency_del').val(data[6]);
		$('#description_del').val(data[7]);
		$('#del_action').val('deleteData');
	});
	$("#delModal").on('submit','#delForm', function(event){
		event.preventDefault();
		$('#del_save').attr('disabled','disabled');
		$('#id_delErr').text("*");
		$('#name_delErr').text("*");
		$('#src_delErr').text("*");
		$('#price_delErr').text("*");
		$('#currency_delErr').text("*");
		$('#description_delErr').text("");

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
				url:"../controller/product_ctrl.php",
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
					if(result.nameErr != ""){
						$('#name_delErr').text("*"+result.nameErr);
					}
					if(result.srcErr != ""){
						$('#src_delErr').text("*"+result.srcErr);
					}
					if(result.priceErr != ""){
						$('#price_delErr').text("*"+result.priceErr);
					}
					if(result.currencyErr != ""){
						$('#currency_delErr').text("*"+result.currencyErr);
					}
					if(result.descriptionErr != ""){
						$('#description_delErr').text(result.descriptionErr);
					}

					if(result.error == "error"){
						alert("Delete product failed!");
					}
					else if(result.error == "success"){
						$('#delForm')[0].reset();
						$('#delModal').modal('hide');
						dataTable.ajax.reload();
						alert("Delete product success!");
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
			alert("Delete product failed!");
		}
		$('#del_save').attr('disabled', false);
	});

});

function validateProductName(name) { 
	var letters = /^[a-zA-Z0-9\s]{1,50}$/;
	if(name.match(letters))
		return true;
	else
		return false;
}
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