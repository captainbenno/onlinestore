<?php 

print_r($_REQUEST);

?>

<form method="get">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" />
    <label for="password">Password</label>
    <input type="text" class="form-control" id="password" name="password" placeholder="Enter password" />
 </div>
  <input type="submit" class="btn btn-default" value="Login" />
</form>