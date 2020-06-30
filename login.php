

<?php
 //session_start();
 require_once "config.php";
 require_once "gconfig.php";
use PHPMailer\PHPMailer\PHPMailer;
include_once('link.php');


function getUserIpAddr(){
  if(!empty($_SERVER['HTTP_CLIENT_IP'])){
      //ip from share internet
      $ip = $_SERVER['HTTP_CLIENT_IP'];
  }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
      //ip pass from proxy
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }else{
      $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}

$ip = getUserIpAddr();
//echo $ip;
//$_SESSION[$ip]='';

if(!$_SESSION[$ip]){
  $_SESSION[$ip] = 0;
}

if ($_SESSION[$ip] >= 5){
  header("Location: Login.php");
  echo "You have failed to login 5 times so you can't login again";
}

$redirectURL = "http://localhost/loginform/RegistrationLogin/fb-callback.php";
$permissions = ['email'];
$loginURL = $helper->getLoginUrl($redirectURL, $permissions);
$loginURLg = $gClient->createAuthUrl();

//echo $loginURL;
if(isset($_POST['login'])){

  require_once('connection.php');
  $email = $password = $pwd = '';
  
  $email = $_POST['email'];
  
  $pwd = $_POST['password'];
  $password = md5($pwd);
  

$mysqli = new mysqli('localhost','root','','phani');	


	if((isset($_POST['captcha']) && $_POST['captcha'] == $_SESSION['captcha_code']) || ($_SESSION[$ip] < 3)) {
  $sql = "SELECT * FROM registration WHERE Email='$email' AND Password1='$password'";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) >0  )
  {
    //$mysqli->query("DELETE FROM loginattempts WHERE IP = '$ip'");
    $_SESSION[$ip] = 0;
    $subject = "Email verification";
        $body = "You are logged in Kramah page";

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
            $response = "Email is sent!";
            header("Location: welcome.php");
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }

        exit(json_encode(array("status" => $status, "response" => $response)));
    
  }
  else
  {

    echo "Invalid email or password";
    
    if($_SESSION[$ip])$_SESSION[$ip] = $_SESSION[$ip]+1;
    else $_SESSION[$ip] = 1;

   
  }
}
else {
  echo "Invalid Captcha";
}

}



?>

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<body>
<div id="frmRegistration">
<form class="form-horizontal" method="POST" action="">
	<h1>User Login</h1>
	
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-6">
      <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
    </div>
  </div>
  <div id ="none1" class="form-group">
    <label class="control-label col-sm-2" for="pwd">Password:</label>
    <div class="col-sm-6"> 
      <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
    </div>
  </div>

  <?php if ($_SESSION[$ip] >= 3) { ?>
      <tr class="tablerow">
      <td align="right"></td>
     
		<td><img src="captcha_code.php" /><br><br><input name="captcha" id="captcha"  type="text"  placeholder="Enter above captcha" ></td>
		</tr>
		<?php } ?>

  <div  id ="none1" class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="login" class="btn btn-primary">Login</button>
    </div>
   
  
	
  
  <div id ="none1" class="form-group"> 

	<div class="nav navbar-nav">
			
			<a href="registration.php">New Registration</a> 
			
	</div>
	</div>

  <input type="button" onclick="window.location = '<?php echo $loginURL ?>';" value="Log In With Facebook" class="btn btn-primary">
	<input type="button" onclick="window.location = '<?php echo $loginURLg ?>';" value="Log In With Google" class="btn btn-danger">

  <div class="form-group">
	<div class="nav navbar-nav">
	<br>
			<a href="forgotpass.php">forgot password?</a>
	</div>
	</div>
  </div>
</form>
</div>
</body>