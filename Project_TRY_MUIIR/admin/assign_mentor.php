<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Page</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#search").keyup(function() {
				var query = $(this).val();
				if (query != '') {
					$.ajax({
						url: 'search.php',
						method: 'POST',
						data: {
							query: query
						},
						success: function(data) {
							$("#result").html(data);
						}
					});
				} else {
					$("#result").html('');
				}
			});
		});
	</script>
	<!-- Custom CSS -->
	<style>
		.card-header,
		.btn {
			background-color: #337ab7;
			/* Change this to your desired color */
			text-align: center;
		}

		.card {
			max-width: 500px;
			margin: auto;
			background-color: #f5f5f5;
			border: 1px solid #e3e3e3;
		}

		@media (max-width: 576px) {
			.card {
				margin-top: 20px;
			}
		}

		.form-control {
			display: block;
			width: 100%;
			height: 34px;
			padding: 6px 12px;
			font-size: 14px;
			line-height: 1.42857143;
			color: #555;
			background-color: #fff;
			background-image: none;
			border: 1px solid #ccc;
			border-radius: 4px;
		}
	</style>
</head>

<body>

	<!-- Login Form -->
	<div class="container my-5">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header text-white">
						<h4>Assign Mentor</h4>
					</div>
					<div class="card-body">
						<form method="POST">
							<div class="form-group">
								<label>Mentor ID<span style="color:red;" class="required"> *</span></label>
								<input type="text" class="form-control" name="Mentor ID" required>
							</div>

							<input type="text" id="search" placeholder="Search Student...">
							<div id="result"></div>

							<div class="form-group">
								<label>Username<span style="color:red;" class="required"> *</span></label>
								<input type="text" class="form-control" name="username" required>
							</div>
							<div class="form-group">
								<label>Password<span style="color:red;" class="required"> *</span></label>
								<input type="password" class="form-control" name="password" required>
							</div>
							<div class="form-group d-flex justify-content-center">
								<button type="submit" name="submit" class="btn btn-primary">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>