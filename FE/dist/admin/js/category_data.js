$(document).ready(function(){	
	$("#categories").attr("class", "active");

	var dataTable = $('#table-admin').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"pagingType": "full_numbers",
		language: {
			search: "_INPUT_",
			searchPlaceholder: "Search Categories"
		},
		responsive: true,
		"pageLength": 10,
		"order":[],
		"ajax":{
			url:"../controller/category_ctrl.php",
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
		$('#descriptionErr').text("");
		
		// Check client input
		var errClient = false;
		if (($('#name').val()).trim() == "") {
			$('#nameErr').text("* Name is required.");
			errClient = true;
		}
		else if (!validateCategoryName($('#name').val())) {
			$('#nameErr').text("* Only letters, numbers and white space allowed. Limited to 32 characters.");
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
				url:"../controller/category_ctrl.php",
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
					if(result.descriptionErr != ""){
						$('#descriptionErr').text(result.descriptionErr);
					}
					
					if(result.error == "error"){
						alert("Add new category failed!");
					}
					else if(result.error == "success"){
						$('#addForm')[0].reset();
						$('#addModal').modal('hide');
						dataTable.ajax.reload();
						alert("Add new category success!");
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
			alert("Add new category failed!");
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
		$('#name_edt').val(data[2]);
		$('#description_edt').val(data[3]);
		$('#edt_action').val('updateData');
	});
	$("#edtModal").on('submit','#edtForm', function(event){
		event.preventDefault();
		$('#edt_save').attr('disabled','disabled');
		$('#id_edtErr').text("*");
		$('#name_edtErr').text("*");
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
		else if (!validateCategoryName($('#name_edt').val())) {
			$('#name_edtErr').text("* Only letters, numbers and white space allowed. Limited to 32 characters.");
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
				url:"../controller/category_ctrl.php",
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
					if(result.descriptionErr != ""){
						$('#description_edtErr').text(result.descriptionErr);
					}

					if(result.error == "error"){
						alert("Edit category failed!");
					}
					else if(result.error == "success"){
						$('#edtForm')[0].reset();
						$('#edtModal').modal('hide');
						dataTable.ajax.reload();
						alert("Edit category success!");
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
			alert("Edit category failed!");
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
		$('#name_del').val(data[2]);
		$('#description_del').val(data[3]);
		$('#del_action').val('deleteData');
	});
	$("#delModal").on('submit','#delForm', function(event){
		event.preventDefault();
		$('#del_save').attr('disabled','disabled');
		$('#id_delErr').text("*");
		$('#name_delErr').text("*");
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
				url:"../controller/category_ctrl.php",
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
					if(result.descriptionErr != ""){
						$('#description_delErr').text(result.descriptionErr);
					}

					if(result.error == "error"){
						alert("Delete category failed!");
					}
					else if(result.error == "success"){
						$('#delForm')[0].reset();
						$('#delModal').modal('hide');
						dataTable.ajax.reload();
						alert("Delete category success!");
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
			alert("Delete category failed!");
		}
		$('#del_save').attr('disabled', false);
	});

});

function validateCategoryName(name) { 
	var letters = /^[a-zA-Z0-9\s]{1,32}$/;
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