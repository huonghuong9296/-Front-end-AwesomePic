$(document).ready(function(){	
	$("#users").attr("class", "active");

	var dataTable = $('#table-admin').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"pagingType": "full_numbers",
		language: {
			search: "_INPUT_",
			searchPlaceholder: "Search Users"
		},
		responsive: true,
		"pageLength": 10,
		"order":[],
		"ajax":{
			url:"../controller/user_ctrl.php",
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
		$('#firstnameErr').text("*");
		$('#lastnameErr').text("*");
		$('#usernameErr').text("*");
		$('#passwordErr').text("*");
		$('#emailErr').text("*");
		$('#phoneErr').text("*");
		$('#addressErr').text("");
		$('#cityErr').text("");
		$('#countryErr').text("");
		
		// Check client input
		var errClient = false;
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
		
		if (($('#username').val()).trim() == "") {
			$('#usernameErr').text("* Username is required.");
			errClient = true;
		}
		else if (!validateUsername($('#username').val())) {
			$('#usernameErr').text("* Invalid username format! String from 6-32 characters.");
			errClient = true;
		}

		if (($('#password').val()).trim() == "") {
			$('#passwordErr').text("* Password is required.");
			errClient = true;
		}
		else if (($('#password').val()).length < 8 || ($('#password').val()).length > 20 ) {
			$('#passwordErr').text("* Invalid password! String from 8-20 characters.");
			errClient = true;
		}

		if (($('#email').val()).trim() == "") {
			$('#emailErr').text("* Email is required.");
			errClient = true;
		}
		else if (!validateEmail($('#email').val())) {
			$('#emailErr').text("* Invalid email format!");
			errClient = true;
		}
		else if (($('#email').val()).length > 50 ) {
			$('#emailErr').text("* Invalid email! Limited to 50 characters.");
			errClient = true;
		}

		if (($('#phone').val()).trim() == "") {
			$('#phoneErr').text("* Phone is required.");
			errClient = true;
		}
		else if (!validatePhone($('#phone').val())) {
			$('#phoneErr').text("* Invalid phone format! From 6-12 numbers.");
			errClient = true;
		}

		if (($('#address').val()).length > 100 ) {
			$('#addressErr').text(" Invalid address! Limited to 100 characters.");
			errClient = true;
		}
		if (($('#city').val()).length > 32 ) {
			$('#cityErr').text(" Invalid city! Limited to 32 characters.");
			errClient = true;
		}
		if (($('#country').val()).length > 32 ) {
			$('#countryErr').text(" Invalid country! Limited to 32 characters.");
			errClient = true;
		}
		// end Check client input
		
		if (errClient == false) {
			var formData = $(this).serialize();
			$.ajax({
				url:"../controller/user_ctrl.php",
				method:"POST",
				data:formData,
				dataType: "json",
				success:function(result){			
					if (!result.hasOwnProperty('error')){
						alert('Error handling service!');
					}
					
					if(result.firstnameErr != ""){
						$('#firstnameErr').text("*"+result.firstnameErr);
					}
					if(result.lastnameErr != ""){
						$('#lastnameErr').text("*"+result.lastnameErr);
					}
					if(result.usernameErr != ""){
						$('#usernameErr').text("*"+result.usernameErr);
					}
					if(result.passwordErr != ""){
						$('#passwordErr').text("*"+result.passwordErr);
					}
					if(result.emailErr != ""){
						$('#emailErr').text("*"+result.emailErr);
					}
					if(result.phoneErr != ""){
						$('#phoneErr').text("*"+result.phoneErr);
					}
					if(result.addressErr != ""){
						$('#addressErr').text(result.addressErr);
					}
					if(result.cityErr != ""){
						$('#cityErr').text(result.cityErr);
					}
					if(result.countryErr != ""){
						$('#countryErr').text(result.countryErr);
					}

					if(result.error == "error"){
						alert("Add new user failed!");
					}
					else if(result.error == "success"){
						$('#addForm')[0].reset();
						$('#addModal').modal('hide');
						dataTable.ajax.reload();
						alert("Add new user success!");
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
			alert("Add new user failed!");
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
		$('#username_edt').val(data[2]);
		$('#password_edt').val(data[3]);
		$('#email_edt').val(data[4]);
		$('#firstname_edt').val(data[5]);
		$('#lastname_edt').val(data[6]);
		$('#phone_edt').val(data[7]);
		$('#address_edt').val(data[8]);
		$('#city_edt').val(data[9]);
		$('#country_edt').val(data[10]);
		$('#edt_action').val('updateData');
	});
	$("#edtModal").on('submit','#edtForm', function(event){
		event.preventDefault();
		$('#edt_save').attr('disabled','disabled');
		$('#id_edtErr').text("*");
		$('#firstname_edtErr').text("*");
		$('#lastname_edtErr').text("*");
		$('#username_edtErr').text("*");
		$('#password_edtErr').text("*");
		$('#email_edtErr').text("*");
		$('#phone_edtErr').text("*");
		$('#address_edtErr').text("");
		$('#city_edtErr').text("");
		$('#country_edtErr').text("");

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
		
		if (($('#username_edt').val()).trim() == "") {
			$('#username_edtErr').text("* Username is required.");
			errClient = true;
		}
		else if (!validateUsername($('#username_edt').val())) {
			$('#username_edtErr').text("* Invalid username format! String from 6-32 characters.");
			errClient = true;
		}

		if (($('#password_edt').val()).trim() == "") {
			$('#password_edtErr').text("* Password is required.");
			errClient = true;
		}
		else if (($('#password_edt').val()).length < 8 || ($('#password_edt').val()).length > 20 ) {
			$('#password_edtErr').text("* Invalid password! String from 8-20 characters.");
			errClient = true;
		}

		if (($('#email_edt').val()).trim() == "") {
			$('#email_edtErr').text("* Email is required.");
			errClient = true;
		}
		else if (!validateEmail($('#email_edt').val())) {
			$('#email_edtErr').text("* Invalid email format!");
			errClient = true;
		}
		else if (($('#email_edt').val()).length > 50 ) {
			$('#email_edtErr').text("* Invalid email! Limited to 50 characters.");
			errClient = true;
		}

		if (($('#phone_edt').val()).trim() == "") {
			$('#phone_edtErr').text("* Phone is required.");
			errClient = true;
		}
		else if (!validatePhone($('#phone_edt').val())) {
			$('#phone_edtErr').text("* Invalid phone format! From 6-12 numbers.");
			errClient = true;
		}

		if (($('#address_edt').val()).length > 100 ) {
			$('#address_edtErr').text(" Invalid address! Limited to 100 characters.");
			errClient = true;
		}
		if (($('#city_edt').val()).length > 32 ) {
			$('#city_edtErr').text(" Invalid city! Limited to 32 characters.");
			errClient = true;
		}
		if (($('#country_edt').val()).length > 32 ) {
			$('#countryErr_edt').text(" Invalid country! Limited to 32 characters.");
			errClient = true;
		}
		// end Check client input

		if (errClient == false) {
			var formData = $(this).serialize();
			$.ajax({
				url:"../controller/user_ctrl.php",
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
					if(result.firstnameErr != ""){
						$('#firstname_edtErr').text("*"+result.firstnameErr);
					}
					if(result.lastnameErr != ""){
						$('#lastname_edtErr').text("*"+result.lastnameErr);
					}
					if(result.usernameErr != ""){
						$('#username_edtErr').text("*"+result.usernameErr);
					}
					if(result.passwordErr != ""){
						$('#password_edtErr').text("*"+result.passwordErr);
					}
					if(result.emailErr != ""){
						$('#email_edtErr').text("*"+result.emailErr);
					}
					if(result.phoneErr != ""){
						$('#phone_edtErr').text("*"+result.phoneErr);
					}
					if(result.addressErr != ""){
						$('#address_edtErr').text(result.addressErr);
					}
					if(result.cityErr != ""){
						$('#city_edtErr').text(result.cityErr);
					}
					if(result.countryErr != ""){
						$('#country_edtErr').text(result.countryErr);
					}

					if(result.error == "error"){
						alert("Edit user failed!");
					}
					else if(result.error == "success"){
						$('#edtForm')[0].reset();
						$('#edtModal').modal('hide');
						dataTable.ajax.reload();
						alert("Edit user success!");
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
			alert("Edit user failed!");
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
		$('#username_del').val(data[2]);
		$('#password_del').val(data[3]);
		$('#email_del').val(data[4]);
		$('#firstname_del').val(data[5]);
		$('#lastname_del').val(data[6]);
		$('#phone_del').val(data[7]);
		$('#address_del').val(data[8]);
		$('#city_del').val(data[9]);
		$('#country_del').val(data[10]);
		$('#del_action').val('deleteData');
	});
	$("#delModal").on('submit','#delForm', function(event){
		event.preventDefault();
		$('#del_save').attr('disabled','disabled');
		$('#id_delErr').text("*");
		$('#firstname_delErr').text("*");
		$('#lastname_delErr').text("*");
		$('#username_delErr').text("*");
		$('#password_delErr').text("*");
		$('#email_delErr').text("*");
		$('#phone_delErr').text("*");
		$('#address_delErr').text("");
		$('#city_delErr').text("");
		$('#country_delErr').text("");

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
				url:"../controller/user_ctrl.php",
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
					if(result.firstnameErr != ""){
						$('#firstname_delErr').text("*"+result.firstnameErr);
					}
					if(result.lastnameErr != ""){
						$('#lastname_delErr').text("*"+result.lastnameErr);
					}
					if(result.usernameErr != ""){
						$('#username_delErr').text("*"+result.usernameErr);
					}
					if(result.passwordErr != ""){
						$('#password_delErr').text("*"+result.passwordErr);
					}
					if(result.emailErr != ""){
						$('#email_delErr').text("*"+result.emailErr);
					}
					if(result.phoneErr != ""){
						$('#phone_delErr').text("*"+result.phoneErr);
					}
					if(result.addressErr != ""){
						$('#address_delErr').text(result.addressErr);
					}
					if(result.cityErr != ""){
						$('#city_delErr').text(result.cityErr);
					}
					if(result.countryErr != ""){
						$('#country_delErr').text(result.countryErr);
					}

					if(result.error == "error"){
						alert("Delete user failed!");
					}
					else if(result.error == "success"){
						$('#delForm')[0].reset();
						$('#delModal').modal('hide');
						dataTable.ajax.reload();
						alert("Delete user success!");
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
			alert("Delete user failed!");
		}
		$('#del_save').attr('disabled', false);
	});

});

function validateEmail(email) {
	var atposition = email.indexOf("@");
	var dotposition = email.lastIndexOf(".");
	if (atposition < 1 || dotposition < (atposition + 2) || (dotposition + 2) >= email.length)
	  	return false;
	else {
		var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
		if (email.match(mailformat))
			return true;
		else
			return false;
	}
}
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
function validateUsername(username) { 
	var letters = /^[A-Za-z0-9_\.]{6,32}$/;
	if(username.match(letters))
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