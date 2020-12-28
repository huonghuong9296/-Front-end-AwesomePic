$(document).ready(function(){	
	$("#employees").attr("class", "active");

	var dataTable = $('#table-admin').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"pagingType": "full_numbers",
		language: {
			search: "_INPUT_",
			searchPlaceholder: "Search Employees"
		},
		responsive: true,
		"pageLength": 10,
		"order":[],
		"ajax":{
			url:"../controller/employee_ctrl.php",
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
		// $('#companynameErr').text("*");
		$('#firstnameErr').text("*");
		$('#lastnameErr').text("*");
		$('#jobErr').text("*");
		$('#phoneErr').text("*");
		$('#facebookErr').text("");
		$('#instagramErr').text("");
		$('#twitterErr').text("");
		$('#descriptionErr').text("");
		
		// Check client input
		var errClient = false;

		// if (($('#companyname').val()).trim() == "") {
		// 	$('#companynameErr').text("* Company name is required.");
		// 	errClient = true;
		// }
		// else if (($('#companyname').val()).length > 100 ) {
		// 	$('#companynameErr').text("* Invalid company name! Limited to 100 characters.");
		// 	errClient = true;
		// }

		if (($('#firstname').val()).trim() == "") {
			$('#firstnameErr').text("* First name is required.");
			errClient = true;
		}
		else if (!validateFirstname($('#firstname').val())) {
			$('#firstnameErr').text("* Only letters allowed. Limited to 20 characters.");
			errClient = true;
		}

		if (($('#lastname').val()).trim() == "") {
			$('#lastnameErr').text("* Last name is required.");
			errClient = true;
		}
		else if (!validateLastname($('#lastname').val())) {
			$('#lastnameErr').text("* Only letters and white space allowed. Limited to 32 characters.");
			errClient = true;
		}
		
		if (($('#job').val()).trim() == "") {
			$('#jobErr').text("* Job is required.");
			errClient = true;
		}
		else if (($('#job').val()).length > 100 ) {
			$('#jobErr').text("* Invalid Job! Limited to 100 characters.");
			errClient = true;
		}

		else if (!validatePhone($('#phone').val())) {
			$('#phoneErr').text("* Invalid phone format! From 6-12 numbers.");
			errClient = true;
		}

		if (($('#facebook').val()).length > 200 ) {
			$('#facebookErr').text(" Invalid facebook! Limited to 200 characters.");
			errClient = true;
		}
		if (($('#instagram').val()).length > 200 ) {
			$('#instagramErr').text(" Invalid instagram! Limited to 200 characters.");
			errClient = true;
		}
		if (($('#twitter').val()).length > 200 ) {
			$('#twitterErr').text(" Invalid twitter! Limited to 200 characters.");
			errClient = true;
		}
		if (($('#description').val()).length > 500 ) {
			$('#descriptionErr').text(" Invalid description! Limited to 500 characters.");
			errClient = true;
		}
		// end Check client input
		
		if (errClient == false) {
			var formData = $(this).serialize();
			$.ajax({
				url:"../controller/employee_ctrl.php",
				method:"POST",
				data:formData,
				dataType: "json",
				success:function(result){			
					if (!result.hasOwnProperty('error')){
						alert('Error handling service!');
					}
					
					// if(result.companynameErr != ""){
					// 	$('#companynameErr').text("*"+result.companynameErr);
					// }
					if(result.firstnameErr != ""){
						$('#firstnameErr').text("*"+result.firstnameErr);
					}
					if(result.lastnameErr != ""){
						$('#lastnameErr').text("*"+result.lastnameErr);
					}
					if(result.jobErr != ""){
						$('#jobErr').text("*"+result.jobErr);
					}
					if(result.phoneErr != ""){
						$('#phoneErr').text("*"+result.phoneErr);
					}
					if(result.facebookErr != ""){
						$('#facebookErr').text(result.facebookErr);
					}
					if(result.instagramErr != ""){
						$('#instagramErr').text(result.instagramErr);
					}
					if(result.twitterErr != ""){
						$('#twitterErr').text(result.twitterErr);
					}
					if(result.descriptionErr != ""){
						$('#descriptionErr').text(result.descriptionErr);
					}

					if(result.error == "error"){
						alert("Add new employee failed!");
					}
					else if(result.error == "success"){
						$('#addForm')[0].reset();
						$('#addModal').modal('hide');
						dataTable.ajax.reload();
						alert("Add new employee success!");
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
			alert("Add new employee failed!");
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
		// $('#companyname_edt').val(data[2]);
		$('#firstname_edt').val(data[2]);
		$('#lastname_edt').val(data[3]);
		$('#job_edt').val(data[4]);
		$('#phone_edt').val(data[5]);
		$('#facebook_edt').val(data[6]);
		$('#instagram_edt').val(data[7]);
		$('#twitter_edt').val(data[8]);
		$('#description_edt').val(data[9]);
		$('#edt_action').val('updateData');
	});
	$("#edtModal").on('submit','#edtForm', function(event){
		event.preventDefault();
		$('#edt_save').attr('disabled','disabled');
		$('#id_edtErr').text("*");
		// $('#companyname_edtErr').text("*");
		$('#firstname_edtErr').text("*");
		$('#lastname_edtErr').text("*");
		$('#job_edtErr').text("*");
		$('#phone_edtErr').text("*");
		$('#facebook_edtErr').text("");
		$('#instagram_edtErr').text("");
		$('#twitter_edtErr').text("");
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

		// if (($('#companyname_edt').val()).trim() == "") {
		// 	$('#companyname_edtErr').text("* Company name is required.");
		// 	errClient = true;
		// }
		// else if (($('#companyname_edt').val()).length > 100 ) {
		// 	$('#companyname_edtErr').text("* Invalid company name! Limited to 100 characters.");
		// 	errClient = true;
		// }

		if (($('#firstname_edt').val()).trim() == "") {
			$('#firstname_edtErr').text("* First name is required.");
			errClient = true;
		}
		else if (!validateFirstname($('#firstname_edt').val())) {
			$('#firstname_edtErr').text("* Only letters allowed. Limited to 20 characters.");
			errClient = true;
		}

		if (($('#lastname_edt').val()).trim() == "") {
			$('#lastname_edtErr').text("* Last name is required.");
			errClient = true;
		}
		else if (!validateLastname($('#lastname_edt').val())) {
			$('#lastname_edtErr').text("* Only letters and white space allowed. Limited to 32 characters.");
			errClient = true;
		}
		
		if (($('#job_edt').val()).trim() == "") {
			$('#job_edtErr').text("* Job is required.");
			errClient = true;
		}
		else if (($('#job_edt').val()).length > 100 ) {
			$('#job_edtErr').text("* Invalid Job! Limited to 100 characters.");
			errClient = true;
		}

		else if (!validatePhone($('#phone_edt').val())) {
			$('#phone_edtErr').text("* Invalid phone format! From 6-12 numbers.");
			errClient = true;
		}

		if (($('#facebook_edt').val()).length > 200 ) {
			$('#facebook_edtErr').text(" Invalid facebook! Limited to 200 characters.");
			errClient = true;
		}
		if (($('#instagram_edt').val()).length > 200 ) {
			$('#instagram_edtErr').text(" Invalid instagram! Limited to 200 characters.");
			errClient = true;
		}
		if (($('#twitter_edt').val()).length > 200 ) {
			$('#twitter_edtErr').text(" Invalid twitter! Limited to 200 characters.");
			errClient = true;
		}
		if (($('#description_edt').val()).length > 500 ) {
			$('#description_edtErr').text(" Invalid description! Limited to 500 characters.");
			errClient = true;
		}
		// end Check client input

		if (errClient == false) {
			var formData = $(this).serialize();
			$.ajax({
				url:"../controller/employee_ctrl.php",
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
					// if(result.companynameErr != ""){
					// 	$('#companyname_edtErr').text("*"+result.companynameErr);
					// }
					if(result.firstnameErr != ""){
						$('#firstname_edtErr').text("*"+result.firstnameErr);
					}
					if(result.lastnameErr != ""){
						$('#lastname_edtErr').text("*"+result.lastnameErr);
					}
					if(result.jobErr != ""){
						$('#job_edtErr').text("*"+result.jobErr);
					}
					if(result.phoneErr != ""){
						$('#phone_edtErr').text("*"+result.phoneErr);
					}
					if(result.facebookErr != ""){
						$('#facebook_edtErr').text(result.facebookErr);
					}
					if(result.instagramErr != ""){
						$('#instagram_edtErr').text(result.instagramErr);
					}
					if(result.twitterErr != ""){
						$('#twitter_edtErr').text(result.twitterErr);
					}
					if(result.descriptionErr != ""){
						$('#description_edtErr').text(result.descriptionErr);
					}

					if(result.error == "error"){
						alert("Edit employee failed!");
					}
					else if(result.error == "success"){
						$('#edtForm')[0].reset();
						$('#edtModal').modal('hide');
						dataTable.ajax.reload();
						alert("Edit employee success!");
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
			alert("Edit employee failed!");
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
		// $('#companyname_del').val(data[2]);
		$('#firstname_del').val(data[2]);
		$('#lastname_del').val(data[3]);
		$('#job_del').val(data[4]);
		$('#phone_del').val(data[5]);
		$('#facebook_del').val(data[6]);
		$('#instagram_del').val(data[7]);
		$('#twitter_del').val(data[8]);
		$('#description_del').val(data[9]);
		$('#del_action').val('deleteData');
	});
	$("#delModal").on('submit','#delForm', function(event){
		event.preventDefault();
		$('#del_save').attr('disabled','disabled');
		$('#id_delErr').text("*");
		// $('#companyname_delErr').text("*");
		$('#firstname_delErr').text("*");
		$('#lastname_delErr').text("*");
		$('#job_delErr').text("*");
		$('#phone_delErr').text("*");
		$('#facebook_delErr').text("");
		$('#instagram_delErr').text("");
		$('#twitter_delErr').text("");
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
				url:"../controller/employee_ctrl.php",
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
					// if(result.companynameErr != ""){
					// 	$('#companyname_delErr').text("*"+result.companynameErr);
					// }
					if(result.firstnameErr != ""){
						$('#firstname_delErr').text("*"+result.firstnameErr);
					}
					if(result.lastnameErr != ""){
						$('#lastname_delErr').text("*"+result.lastnameErr);
					}
					if(result.jobErr != ""){
						$('#job_delErr').text("*"+result.jobErr);
					}
					if(result.phoneErr != ""){
						$('#phone_delErr').text("*"+result.phoneErr);
					}
					if(result.facebookErr != ""){
						$('#facebook_delErr').text(result.facebookErr);
					}
					if(result.instagramErr != ""){
						$('#instagram_delErr').text(result.instagramErr);
					}
					if(result.twitterErr != ""){
						$('#twitter_delErr').text(result.twitterErr);
					}
					if(result.descriptionErr != ""){
						$('#description_delErr').text(result.descriptionErr);
					}

					if(result.error == "error"){
						alert("Delete employee failed!");
					}
					else if(result.error == "success"){
						$('#delForm')[0].reset();
						$('#delModal').modal('hide');
						dataTable.ajax.reload();
						alert("Delete employee success!");
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
			alert("Delete employee failed!");
		}
		$('#del_save').attr('disabled', false);
	});

});

function validateFirstname(firstname) { 
	var letters = /^[a-zA-Z]{1,20}$/;
	if(firstname.match(letters))
		return true;
	else
		return false;
}
function validateLastname(lastname) { 
	var letters = /^[a-zA-Z-' ]{1,32}$/;
	if(lastname.match(letters))
		return true;
	else
		return false;
}
function validatePhone(phone) { 
	var letters = /^[0-9]{6,12}$/;
	if(phone.match(letters))
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