$(document).ready(function(){	
	$.ajax({
		url:"../controller/dashboard_ctrl.php",
		method:"POST",
		data:{action:'dashboardInfo'},
		dataType: "json",
		success:function(result){			
  
			$('#revenue-month').text('$'+number_format(result.revenue_month, 2, '.', ','));
			$('#total-orders-month').text('$'+number_format(result.total_order_month, 0, '.', ','));
			$('#quantity-sale-month').text(number_format(result.total_quantity_sale_month, 0, '.', ','));
			$('#revenue-year').text('$'+number_format(result.revenue_year, 2, '.', ','));
			$('#total-orders-year').text('$'+number_format(result.total_order_year, 0, '.', ','));
			$('#quantity-sale-year').text(number_format(result.total_quantity_sale_year, 0, '.', ','));
			$('#total-products').text(number_format(result.total_products, 0, '.', ','));
			$('#total-users').text(number_format(result.total_users, 0, '.', ','));
			$('#total-employees').text(number_format(result.total_employees, 0, '.', ','));

			$('#company_name').text(result.company_info.name);
			$('#company_phone').text(result.company_info.phone);
			$('#company_email').text(result.company_info.email);
			$('#company_address').text(result.company_info.address);
			$('#company_city').text(result.company_info.city);
			$('#company_country').text(result.company_info.country);
			$('#company_description').text(result.company_info.description);
			$('#company_logo_src').text(result.company_info.logo);
			document.getElementById('company_logo_img').src = result.company_info.logo;
			
			var ctxRevenue = document.getElementById("myAreaChart");
			var myLineChart = new Chart(ctxRevenue, {
			  type: 'line',
			  data: {
				  labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				  datasets: [{
					  label: "Revenue",
					  lineTension: 0.3,
					  backgroundColor: "rgba(78, 115, 223, 0.05)",
					  borderColor: "rgba(78, 115, 223, 1)",
					  pointRadius: 3,
					  pointBackgroundColor: "rgba(78, 115, 223, 1)",
					  pointBorderColor: "rgba(78, 115, 223, 1)",
					  pointHoverRadius: 3,
					  pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
					  pointHoverBorderColor: "rgba(78, 115, 223, 1)",
					  pointHitRadius: 10,
					  pointBorderWidth: 2,
					  data: result.revenue_monthly
				  }],
			  },
			  options: {
				  maintainAspectRatio: false,
				  layout: {
					  padding: {
						  left: 10,
						  right: 25,
						  top: 25,
						  bottom: 0
					  }
				  },
				  scales: {
					  xAxes: [{
						  time: {
							  unit: 'date'
						  },
						  gridLines: {
							  display: false,
							  drawBorder: false
						  },
						  ticks: {
							  maxTicksLimit: 12
						  }
					  }],
					  yAxes: [{
						  ticks: {
							  maxTicksLimit: 12,
							  padding: 10,
							  // Include a dollar sign in the ticks
							  callback: function(value, index, values) {
								  return '$' + number_format(value);
							  }
						  },
						  gridLines: {
							  color: "rgb(234, 236, 244)",
							  zeroLineColor: "rgb(234, 236, 244)",
							  drawBorder: false,
							  borderDash: [2],
							  zeroLineBorderDash: [2]
						  }
					  }],
				  },
				  legend: {
					  display: false
				  },
				  tooltips: {
					  backgroundColor: "rgb(255,255,255)",
					  bodyFontColor: "#858796",
					  titleMarginBottom: 10,
					  titleFontColor: '#6e707e',
					  titleFontSize: 14,
					  borderColor: '#dddfeb',
					  borderWidth: 1,
					  xPadding: 15,
					  yPadding: 2,
					  displayColors: false,
					  intersect: false,
					  mode: 'index',
					  caretPadding: 10,
					  callbacks: {
						  label: function(tooltipItem, chart) {
							  var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
							  return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
						  }
					  }
				  }
			  }
			});
			
			var ctxUser = document.getElementById("myBarChart");
			var myBarChart = new Chart(ctxUser, {
				type: 'bar',
				data: {
					labels: ["Feb", "Apr", "Jun", "Aug", "Oct", "Dec"],
					datasets: [{
						label: "Registers",
						backgroundColor: "#4e73df",
						hoverBackgroundColor: "#2e59d9",
						borderColor: "#4e73df",
						data: result.total_users_month,
					}],
				},
				options: {
					maintainAspectRatio: false,
					layout: {
					padding: {
						left: 10,
						right: 25,
						top: 25,
						bottom: 0
					}
					},
					scales: {
						xAxes: [{
							time: {
								unit: 'month'
							},
							gridLines: {
								display: false,
								drawBorder: false
							},
							ticks: {
								maxTicksLimit: 6
							},
							maxBarThickness: 25,
						}],
						yAxes: [{
							ticks: {
								min: 0,
								// max: 15000,
								maxTicksLimit: 5,
								padding: 10,
								callback: function(value, index, values) {
									return number_format(value);
							}
							},
							gridLines: {
								color: "rgb(234, 236, 244)",
								zeroLineColor: "rgb(234, 236, 244)",
								drawBorder: false,
								borderDash: [2],
								zeroLineBorderDash: [2]
							}
						}],
					},
					legend: {
						display: false
					},
					tooltips: {
						titleMarginBottom: 10,
						titleFontColor: '#6e707e',
						titleFontSize: 14,
						backgroundColor: "rgb(255,255,255)",
						bodyFontColor: "#858796",
						borderColor: '#dddfeb',
						borderWidth: 1,
						xPadding: 15,
						yPadding: 15,
						displayColors: false,
						caretPadding: 10,
						callbacks: {
							label: function(tooltipItem, chart) {
								var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
								return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
							}
						}
					},
				}
			});

		},
		error: function (e) {
			alert("Error response service!");
			console.log(e);
		}
	})

	$("#change-company-info").click(function(){
		$('#edtModal').modal('show');
		$('#name_edt').val($('#company_name').text());
		$('#phone_edt').val($('#company_phone').text());
		$('#email_edt').val($('#company_email').text());
		$('#address_edt').val($('#company_address').text());
		$('#city_edt').val($('#company_city').text());
		$('#country_edt').val($('#company_country').text());
		$('#description_edt').val($('#company_description').text());
		$('#logo_edt').val($('#company_logo_src').text());
		$('#edt_action').val('updateCompanyInfo');
	});
	$("#edtModal").on('submit','#edtForm', function(event){
		event.preventDefault();
		$('#edt_save').attr('disabled','disabled');
		$('#name_edtErr').text("*");
		$('#phone_edtErr').text("*");
		$('#email_edtErr').text("*");
		$('#address_edtErr').text("*");
		$('#city_edtErr').text("*");
		$('#country_edtErr').text("*");
		$('#description_edtErr').text("");
		$('#logo_edtErr').text("*");

		// Check client input
		var errClient = false;

		if (($('#name_edt').val()).trim() == "") {
			$('#name_edtErr').text("* Name is required.");
			errClient = true;
		}
		else if (($('#name_edt').val()).length > 250 ) {
			$('#name_edtErr').text("* Limited to 250 characters.");
			errClient = true;
		}

		if (($('#logo_edt').val()).trim() == "") {
			$('#logo_edtErr').text("* Logo is required.");
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

		if (($('#address_edt').val()).trim() == "") {
			$('#address_edtErr').text("* Address is required.");
			errClient = true;
		}
		else if (($('#address_edt').val()).length > 100 ) {
			$('#address_edtErr').text(" Invalid address! Limited to 100 characters.");
			errClient = true;
		}

		if (($('#city_edt').val()).trim() == "") {
			$('#city_edtErr').text("* City is required.");
			errClient = true;
		}
		else if (($('#city_edt').val()).length > 32 ) {
			$('#city_edtErr').text(" Invalid city! Limited to 32 characters.");
			errClient = true;
		}

		if (($('#country_edt').val()).trim() == "") {
			$('#country_edtErr').text("* Country is required.");
			errClient = true;
		}
		else if (($('#country_edt').val()).length > 32 ) {
			$('#countryErr_edt').text(" Invalid country! Limited to 32 characters.");
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
				url:"../controller/dashboard_ctrl.php",
				method:"POST",
				data:formData,
				dataType: "json",
				success:function(result){			
					if (!result.hasOwnProperty('error')){
						alert('Error handling service!');
					}

					if(result.nameErr != ""){
						$('#name_edtErr').text("*"+result.nameErr);
					}
					if(result.logoErr != ""){
						$('#logo_edtErr').text("*"+result.logoErr);
					}
					if(result.descriptionErr != ""){
						$('#description_edtErr').text(result.descriptionErr);
					}
					if(result.emailErr != ""){
						$('#email_edtErr').text("*"+result.emailErr);
					}
					if(result.phoneErr != ""){
						$('#phone_edtErr').text("*"+result.phoneErr);
					}
					if(result.cityErr != ""){
						$('#city_edtErr').text("*"+result.cityErr);
					}
					if(result.addressErr != ""){
						$('#address_edtErr').text("*"+result.Err);
					}
					if(result.addressErr != ""){
						$('#address_edtErr').text("*"+result.addressErr);
					}

					if(result.error == "error"){
						alert("Edit company info failed!");
					}
					else if(result.error == "success"){
						$('#edtForm')[0].reset();
						$('#edtModal').modal('hide');
						location.reload();
						alert("Edit conpany info success!");
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
			alert("Edit company info failed!");
		}
		$('#edt_save').attr('disabled', false);
	});

});
  
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
	// *     example: number_format(1234.56, 2, ',', ' ');
	// *     return: '1 234,56'
	number = (number + '').replace(',', '').replace(' ', '');
	var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function(n, prec) {
			var k = Math.pow(10, prec);
			return '' + Math.round(n * k) / k;
		};
	// Fix for IE parseFloat(0.55).toFixed(0) = 0;
	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}
	if ((s[1] || '').length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');  
	}
	return s.join(dec);
}

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
function validatePhone(phone) { 
	var letters = /^[0-9]{6,12}$/;
	if(phone.match(letters))
		return true;
	else
		return false;
}