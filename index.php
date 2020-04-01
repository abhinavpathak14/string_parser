<!doctype html>
<html lang="en">

<head>
	<title>Job Description Parser</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">Elements</h3>
					<div class="row">
						<div class="col-md-6">
							<form name="parser" id="parser_frm" action="./parser.php" method="post">
								<div class="panel">
									<div class="panel-body">
										<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;" id="error-cont">
											<i class="fa fa-times-circle"></i> <span></span>
										</div>
										<textarea class="form-control" placeholder="Insert Job description here" rows="10" name="job_description" id="job_description">Title: Sample
Reports To: Sales Manager
Based at: Gurgaon Haryana
Job Purpose:
This is sample job purpose.
Scale and territory indicators:
Core product range of four ABC machines price range Rs.50 to Rs.250
Target Sectors: All major multiple-site organizations
Territory: US</textarea>
										<BR />
										<button type="button" id="submitBtn" class="btn btn-primary btn-block">Submit</button>
									</div>
								</div>
							</form>
						</div>
						<div class="col-md-6">
							<!-- LABELS -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Parsed Data</h3>
								</div>
								<div class="panel-body">
									<form name="save" id="save_frm" action="./save.php" method="post">
										<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;" id="error1-cont">
											<i class="fa fa-times-circle"></i> <span></span>
										</div>
										<div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="success-cont">
											<i class="fa fa-times-circle"></i> <span></span>
										</div>
										<input type="text" class="form-control" placeholder="Title" name="title" id="title" />
										<br />
										<input type="text" class="form-control" placeholder="Reports To" name="reports_to" id="reports_to" />
										<br />
										<input type="text" class="form-control" placeholder="Based at" name="based_at" id="based_at" />
										<br />
										<textarea name="job_purpose" rows="4" class="form-control" placeholder="Job Purpose" id="job_purpose"></textarea>
										<br />
										<textarea name="key_responsibilities" rows="4" class="form-control" placeholder="Key responsibilties and accountabilities" id="key_responsibilities_and_accountabilities"></textarea>
										<br />
										<textarea name="scale_territory" rows="4" class="form-control" placeholder="Scale and Territory indicators" id="scale_and_territory_indicators"></textarea>
										<br />
										<textarea name="target_sectors" rows="4" class="form-control" placeholder="Target Sectors" id="target_sectors"></textarea>
										<BR />
										<button type="button" id="saveBtn" class="btn btn-primary btn-block">Save</button>
									</form>
								</div>
							</div>
							<!-- END LABELS -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid"></div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script
	  src="assets/scripts/jquery-3.4.1.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#submitBtn").click(function(){
				$('#submitBtn').attr("disabled", "disabled").text("Processing...");
				var action = $("#parser_frm").attr('action');
				var description = $('#job_description').val();
				$("#error-cont").hide();
				$.post(
					action,
					{job_description: description},
					function(data) {
						$("#submitBtn").removeAttr("disabled").text("Submit");
						if(data.status == true) {
							$.each(data.data, function(key, value){
								$('#'+key).val(value);
							})
						} else {
							$('#error-cont span').text(data.error_msg);
							$('#error-cont').show();
						}
					}, 'json'
				);
			});
			$('#saveBtn').click(function(){
				action = $('#save_frm').attr('action');
				$('#success-cont').hide();
				$('#error1-cont').hide();
				$.post(
					action,
					$('#save_frm').serialize(),
					function(data) {
						if(data.status == true) {
							$('#success-cont span').text(data.msg).show();
							$('#success-cont').show();
						} else {
							$('#error1-cont span').text(data.msg).show();
							$('#error1-cont').show();
						}
					}, 'json'
				);
			});
		})
	</script>
</body>

</html>
