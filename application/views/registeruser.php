<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
  <link rel="stylesheet" href="index.css">
  <link href="<?php echo base_url();?>assets/css/mystyle.css" rel="stylesheet" type="text/css" />
  <title>Document</title>
</head>

<body>
<div class="container">
	<header class="header">
		<h1 id="title" class="text-center">Amusement Park</h1>
		<!-- <p id="description" class="text-center">
			Thank you for taking the time to help us improve the platform
		</p> -->
	</header>
	<div class="form-wrap">	
	<?php echo form_open('Registeruser/register_user', array('id' => 'register_user_form')) ?>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label id="name-label" for="name">RFID No.</label>
						<input type="text" name="rfid_card_no" id="rfid_card_no" placeholder="RFID No." class="form-control" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label id="name-label" for="name">First Name</label>
						<input type="text" name="first_name" id="first_name" placeholder="Enter your First name" class="form-control" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label id="name-label" for="name">Last Name</label>
						<input type="text" name="last_name" id="last_name" placeholder="Enter your Last name" class="form-control" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label id="email-label" for="email">Contact No.</label>
						<input type="text" name="contact_no" id="contact_no" placeholder="Enter your Contact No." class="form-control" required>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-4">
					<button type="submit" id="submit" class="btn btn-primary btn-block">Submit Survey</button>
				</div>
			</div>

	<?php echo form_close() ?>
	</div>	
</div>
</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="<?= base_url();?>assets/js/registeruser.js"></script>