
<?php
include_once('link.php');

if(isset($_POST['create'])){
require_once('connection.php');
$fname = $lname = $gender = $email = $password = $pwd = '';

$org = $_POST['organisation'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$pwd = $_POST['password'];
$password = MD5($pwd);

$sql = "SELECT * FROM registration WHERE Email='$email' ";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) >0  )
{
  echo "Already existed email.";
}
else{
$sql = "INSERT INTO registration (Organisation,Mobile,Email,Password1) VALUES ('$org','$mobile','$email','$password')";
$result = mysqli_query($conn, $sql);


if($result)
{
	header("Location: login.php");
}
else
{
	echo "Error :".$sql;
}
}
}
?>
<body>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<div id="frmRegistration">
<form class="form-horizontal" action="" method="POST">
	<h1>User Registration</h1>

	<div class="form-group">
    <label class="control-label col-sm-2" for="organisation">Organisation Name:</label>
    <div class="col-sm-6">
      <input type="text" name="organisation" class="form-control" id="organisation" placeholder="Enter Organisation" required>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="mobile">Mobile number:</label>
    <div class="col-sm-6">
      <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter mobile no." required>
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-6">
      <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Password:</label>
    <div class="col-sm-6"> 
      <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password" required>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="create" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
</div>
</body>