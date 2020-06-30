

<?php

use PHPMailer\PHPMailer\PHPMailer;
include_once('link.php');
if(isset($_POST['reset'])){
require_once('connection.php');

$token = bin2hex(random_bytes(30));
echo "$token";
$email = $_POST['email'];
$reset = $_POST['reset'];
echo "$reset";
$sql1 = "SELECT * FROM registration WHERE Email='$email'";
$result1 = mysqli_query($conn, $sql1);


if((mysqli_num_rows($result1)) >0 )
{
  $sql2 = "INSERT INTO reset1 (email,token) VALUES ('$email','$token')";
  $result2 = mysqli_query($conn, $sql2);
  
	$subject = "Reset your Password";
        
        $body = "<a href= 'http://localhost/loginform/RegistrationLogin/reset.php?token= $token&email=$email' >reset password </a> <br>";
        $body .="click on above link";
        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "phanindravemireddy@gmail.com"; //enter you email address
        $mail->Password = 'Momanddad@1'; //enter you email password
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email);
        $mail->addAddress("phanindravemireddy@gmail.com"); //enter you email address
        $mail->Subject = ("$subject");
        $mail->Body = $body;

        if ($mail->send()) {
            $status = "success";
            $response = "Email is sent to your registered email to reset your password";
           
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }

        exit(json_encode(array("status" => $status, "response" => $response)));
}
else
{
	echo "Invalid email ID";
}
}

?>
<body>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<div id="frmRegistration">
<form class="form-horizontal" method="POST" action="">
	<h1>Forgot Password</h1>
	
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-6">
      <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
    </div>
 
 
    <div id ="none1" class="col-sm-offset-2 col-sm-10">
     
   <button name="reset" type="submit" class="btn btn-primary">  Reset </a>
   </button>
	 
	 
   </div>
  
  </div>

  </div>
</form>
</body>



