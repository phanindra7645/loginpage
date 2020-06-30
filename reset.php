

<?php
session_start();
include_once('link.php');
if(isset($_POST['submit'])){
require_once('connection.php');

//$email = $_POST['email'];
$pwd1 = $_POST['pass1'];
$password1 = MD5($pwd1);
$pwd2 = $_POST['pass2'];
$password2 = MD5($pwd2);
$token = $_GET['token'];
$email = $_GET['email'];
echo "$email";
echo "$token";
/*
$sql1 = "SELECT email FROM reset1 WHERE token='$token' ";
$results = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($results);
$email = $row['email'];
*/

if( $password1==$password2 ){
  $mysqli = new mysqli('localhost','root','','phani');	

  //$update = $mysqli->query(" UPDATE registration SET Password = '$password1'  WHERE Email='$email'");
  $update = "update registration  set Password1 ='".$password2."' where Email="."'".$email."'";
  echo "update registration  set Password1 =".$password2." where Email="."'".$email."'";
  if($mysqli->query($update) === TRUE )
  {
    header("Location: login.php");
  }
  else{
    echo "something went wrong";
    echo $mysqli->error;
  }
}
else{

   echo "given passwords didn't match";  
}
}
?>

<body>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<div id="frmRegistration">
<form class="form-horizontal" method="POST" action="">
	<h1>Reset your Password</h1>
	
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">New Password:</label>
    <div class="col-sm-6"> 
      <input type="password" class="form-control" name="pass1" id="pwd" placeholder="Enter password" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Confirm Password:</label>
    <div class="col-sm-6"> 
      <input type="password" class="form-control" name="pass2" id="pwd" placeholder="Enter password" required>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
</div>
</body>