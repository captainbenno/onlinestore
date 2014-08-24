<h1>Product Import</h1>
<p>To import data from the remote data source press the button below:</p>
<?php 	if(isset($error_message))
		{ ?>
	<p class="bg-danger"><?php echo $error_message ?></p>	
<?php 	}	
?>
<?php 	if(isset($info_message))
		{ ?>
	<p class="bg-success"><?php echo $info_message ?></p>	
<?php 	}	
?>
<form role="form" class="col-md-8" method="post">
	<input type="hidden" name="import_products" value="1" />
	<input type="submit" class="btn btn-default" value="Import Data" />
</form>