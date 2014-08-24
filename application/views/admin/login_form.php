<h1>Login</h1>
<p>Please enter your login credentials below:</p>
<?php 	if(isset($error_message))
		{ ?>
	<p class="bg-danger"><?php echo $error_message ?></p>	
<?php 	}	
?>
<form role="form" class="col-md-8" method="post">
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" id="username" name="username" placeholder="Enter username" />
		<label for="password">Password</label>
		<input type="password" class="form-control" id="password" name="password" placeholder="Enter password" />
	</div>
	<input type="submit" class="btn btn-default" value="Login" />
</form>