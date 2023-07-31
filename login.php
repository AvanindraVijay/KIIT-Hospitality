<?php
require("db.php");
$err='';
if(isset($_POST['studentLogin'])){
  $rollnumber = mysqli_real_escape_string($db, $_POST['studentRoll']);
  $password = mysqli_real_escape_string($db, $_POST['studentPass']);
 
	$res=mysqli_query($db,"select * from student where rollnumber='$rollnumber'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);	
		$dbpassword=$row['password'];	
   
				if($password==$dbpassword){
                session_start();
                $box=$_SESSION['rollnumber'] = $rollnumber;
                	setcookie('uname',$box,time()+(48*60*60));
                  header("location: ./index.php");
					$arr=array('Status'=>'Login Success','Success Message'=>'Login Successfuly, Please Wait to Redirect....');					  
				}
        else{
					$arr=array('Status'=>'Login Failed','Error Message'=>'Please enter correct password');				 
			} 
	 
	}
  else{
		$arr=array('Status'=>'Login Failed','Error Message'=>'Please enter correct Roll no');
	}
	
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Housekeeper Student Login</title>

  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">  
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Custom Style -->
  <link rel="stylesheet" href="assets/css/main.min.css">

  <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
  <link rel="manifest" href="favicon/site.webmanifest">
</head>
<body>
  <header>
    <div class="row parent-row">
      <!-- Image -->
      <div class="col s1 l7 hide-on-med-and-down">
        <div class="flex-v-center">
        <br/><br/><br/>
        <img src="assets\imgs\bg.png"  width=250px height=100px/><br/>
          <h2>Hostel Housekeeper</h2>
          <p>
            <span id="day_today"></span>
            <span id="date_today"></span>
            <span id="month_today"></span>
            <span id="circle">.</span>
            <span id="year_today"></span>
          </p>
        </div>
      </div>
      <!-- Form -->
      <div class="col s12 l5">
        <div class="center-align form-align">
          <h4>Student Sign In</h4>
          <p class="hide-on-large-only">Get your room cleaned <br>with just few clicks.</p>
          <?php echo $err; ?>
          <div class="row">            
            <form  method="POST" autocomplete="off" class="col s12">            
              <div class="row flex-h-center mb-0">
                <div class="input-field col s8">
                  <input name="studentRoll" type="number" id="rollnumber" class="validate" required>
                  <label for="rollnumber">Roll number</label>
                </div>
              </div>
              <div class="row flex-h-center">
                <div class="input-field col s8">
                  <input name="studentPass" type="password" id="password" class="validate" required>
                  <label for="password">Password</label>
                </div>
              </div>
              <button name="studentLogin" type="submit" class="waves-effect waves-light btn">Continue</button>
            </form>
            <a class="link" href="alogin.php">or Admin login</a>
          </div>
        </div>
      </div>
    </div>

  </header>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>