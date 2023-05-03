<?php 
session_start();
$error = array();

require "mail.php";

	if(!$con = mysqli_connect("localhost","root","","forgot_db")){

		die("could not connect");
	}

	$mode = "enter_email";
	if(isset($_GET['mode'])){
		$mode = $_GET['mode'];
	}

	//something is posted
	if(count($_POST) > 0){

		switch ($mode) {
			case 'enter_email':
				// code...
				$email = $_POST['email'];
				//validate email
				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$error[] = "Please enter a valid email";
				}elseif(!valid_email($email)){
					$error[] = "That email was not found";
				}else{

					$_SESSION['forgot']['email'] = $email;
					send_email($email);
					header("Location: forgot.php?mode=enter_code");
					die;
				}
				break;

			case 'enter_code':
				// code...
				$code = $_POST['code'];
				$result = is_code_correct($code);

				if($result == "the code is correct"){

					$_SESSION['forgot']['code'] = $code;
					header("Location: forgot.php?mode=enter_password");
					die;
				}else{
					$error[] = $result;
				}
				break;

			case 'enter_password':
				// code...
				$password = $_POST['password'];
				$password2 = $_POST['password2'];

				if($password !== $password2){
					$error[] = "Passwords do not match";
				}elseif(!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])){
					header("Location: forgot.php");
					die;
				}else{
					
					save_password($password);
					if(isset($_SESSION['forgot'])){
						unset($_SESSION['forgot']);
					}

					header("Location: login.php");
					die;
				}
				break;
			
			default:
				// code...
				break;
		}
	}

	function send_email($email){
		
		global $con;

		$expire = time() + (60 * 1);
		$code = rand(10000,99999);
		$email = addslashes($email);

		$query = "insert into codes (email,code,expire) value ('$email','$code','$expire')";
		mysqli_query($con,$query);

		//send email here
		send_mail($email,'Password reset',"Your code is " . $code);
	}
	
	function save_password($password){
		
		global $con;

	//	$password = password_hash($password, PASSWORD_DEFAULT);
		$email = addslashes($_SESSION['forgot']['email']);

		$query = "update users set password = '$password' where email = '$email' limit 1";
		mysqli_query($con,$query);

	}
	
	function valid_email($email){
		global $con;

		$email = addslashes($email);

		$query = "select * from users where email = '$email' limit 1";		
		$result = mysqli_query($con,$query);
		if($result){
			if(mysqli_num_rows($result) > 0)
			{
				return true;
 			}
		}

		return false;

	}

	function is_code_correct($code){
		global $con;

		$code = addslashes($code);
		$expire = time();
		$email = addslashes($_SESSION['forgot']['email']);

		$query = "select * from codes where code = '$code' && email = '$email' order by id desc limit 1";
		$result = mysqli_query($con,$query);
		if($result){
			if(mysqli_num_rows($result) > 0)
			{
				$row = mysqli_fetch_assoc($result);
				if($row['expire'] > $expire){

					return "the code is correct";
				}else{
					return "the code is expired";
				}
			}else{
				return "the code is incorrect";
			}
		}

		return "the code is incorrect";
	}

	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>CCIS GUIDE- CCIS GUIDEWebsite </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Free HTML Templates" name="keywords" />
    <meta content="Free HTML Templates" name="description" />

    <!-- Favicon -->


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap"
      rel="stylesheet"
    />

    <!-- Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />

    <!-- Flaticon Font -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- Navbar Start -->
  
    <div  class="container-fluid bg-white position-relative shadow" >
      <nav
        class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-0 px-lg-5"
      >
        <a
          href=""
          class="navbar-brand font-weight-bold text-secondary"
          style="font-size: 50px"
        >
        <img src="CCIS.jpg" alt="Logo" width="80" height="80" class="d-inline-block align-text-top">
          <span class="text-primary">CCIS GUIDE</span>
        </a>
       
        <button
          type="button"
          class="navbar-toggler"
          data-toggle="collapse"
          data-target="#navbarCollapse"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse justify-content-between"
          id="navbarCollapse"
        >
          <div class="navbar-nav font-weight-bold mx-auto py-0">
            <a href="Home.php" class="nav-item nav-link ">Home</a>
            <a href="about.php" class="nav-item nav-link">About us</a>
            <a href="Login.php" class="nav-item nav-link active">Staff login</a>
            <a href="formStudent.php" class="nav-item nav-link">Student/Visitor</a>
            <a href="Request.php" class="nav-item nav-link">Help</a>
            
            
            
    <!-- Navbar End -->

<!--  Searchbar begin -->
            </div>
          </div>
      </div>
      <div class="col-md-8" style="position: relative; margin-top: -5px; margin-left: 25px;">
        <div class="list-group" id="show-list"> 
          <!-- Here autocomplete list will be display -->
        </div>
      </div>
    </div>
  </div>
  
  <style>
    
            .containers {
              max-height: 120px;
              overflow-y: auto;
              overflow-x: hidden;

        top: 0px;
        left: 0px;
        margin: 0;
        z-index: 100;
        font-size: 12px;
        overflow:hidden;
        padding:0;
       top: 0px;
       margin: 15px 0px 0px 0px

            }
            * html .containers {
              height: 100px;
            }
            </style>
</script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="script.js"></script>
  
</body>

        </div>
        <form class="d-flex" role="search">
        </form>
      </nav>
    </div>
    
    
<!--  Searchbar end -->
    <!-- Header Start -->
    <div class="container-fluid bg-primary mb-5">
      <div
        class="d-flex flex-column align-items-center justify-content-center"
        style="min-height: 400px"
      >
        <h3 class="display-3 font-weight-bold text-white">Welcome To Imam University</h3>
        <div class="d-inline-flex text-white">
      
          <p class="m-0">Staff member login</p>
        </div>
      </div>
    </div>
    <!-- Header End -->
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-3 mb-3 mb-lg-0">
          
          </div>
          <div class="col-lg-5">
            <div class="card border-0">
              <form action="" method="POST" >            
<style>
  body {
    background-color: white;
  }
  .login-form {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    padding: 20px;
    width: 350px;
    margin: 0 auto;
    margin-top: 50px;
  }
  .login-form h2 {
    color: #0A4D68;
    text-align: center;
    margin-bottom: 20px;
    background-color: #0A4D68;
    color: #fff;
    font-size: 24px;
    font-weight: bold;
    text-align: center;
    padding: 20px;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
  }
  .form-group {
    margin-bottom: 20px;
    
  }
  .form-group input {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: none;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    font-size: 16px;
    color: #333;
  }
  .form-group input:focus {
    outline: none;
    box-shadow: 0px 0px 5px rgba(33, 150, 243, 0.5);
  }
  #forgot {
    display: block;
    text-align: right;
    margin-bottom: 20px;
    color: #333;
    font-size: 14px;
    text-decoration: none;
  }
  #forgot:hover {
    text-decoration: underline;
  }
  .btn {
    background-color: #2196F3;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
  }
  .btn:hover {
    background-color: #0D47A1;
  }
</style>

<div class="login-form">
  <h2 >Forgot password</h2>
  <span style="font-size: 12px;color:red;">
						
    <style>
  .btn {
    background-color: #038ca1;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
  }
  .btn:hover {
    background-color: #026d7d;
  }
</style>
<?php 

			switch ($mode) {
				case 'enter_email':
					
					?>
						<form method="post" action="forgot.php?mode=enter_email"> 
							<h5>Enter your email below</h5>
							<span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									
									echo $err . "<br>";
								}
							?>
							</span>    <div class="form-group">

							<input class="textbox" type="email" name="email" placeholder="Email" required="required"><br>
							<br style="clear: both;"></div>
							<input class="btn btn-secondary btn-block border-0 py-3" type="submit" value="Next">
              
							<br><br>
							<div><a href="login.php">Login</a></div>
						</form>
					<?php				
					break;

				case 'enter_code':
					
					?>
						<form method="post" action="forgot.php?mode=enter_code"> 
							
							<h5>Enter your the code sent to your email</h5>
							<span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									
									echo $err . "<br>";
								}
							?>
							</span>
              <div class="form-group">
							<input class="textbox" type="text" name="code" placeholder="12345"><br>
							<br style="clear: both;"></div>
							<input class="btn btn-secondary btn-block border-0 py-3" type="submit" value="Next" style="float: right;">
							<a href="forgot.php">
              <br></br>
              <div><a href="forgot.php" value="Start Over">Start Over</a></div>
							</a>

							<div><a href="login.php">Login</a></div>
						</form>
					<?php
					break;

				case 'enter_password':
					
					?>
						<form method="post" action="forgot.php?mode=enter_password"> 
							<h3>Enter your new password</h3>
							<span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									
									echo $err . "<br>";
								}
							?>
							</span>
              <div class="form-group">
							<input class="textbox" type="text" name="password" placeholder="Password"><br>
							<input class="textbox" type="text" name="password2" placeholder="Retype Password"><br>
							<br style="clear: both;"></div>
							<input class="btn btn-secondary btn-block border-0 py-3" type="submit" value="Next" style="float: right;">
							<a href="forgot.php">
              <div><a href="forgot.php" value="Start Over">Start Over</a></div>
							</a>
							
							<div><a href="login.php">Login</a></div>
						</form>
					<?php
					break;
				
				default:
					
					break;
			}

		?>
</form>
</div> 
                 <!-- login End -->
                 
                  </form>
              
            </div>
          </div>
        </div>

    </div>
                  </div>  
                </form>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Registration End -->

    <!-- Footer Start -->
    <div
      class="container-fluid bg-secondary text-white mt-5 py-5 px-sm-3 px-md-5"
    >
      <div class="row pt-5">
        <div class="col-lg-3 col-md-6 mb-5">
          <a
            href=""
            class="navbar-brand font-weight-bold text-primary m-0 mb-4 p-0"
            style="font-size: 40px; line-height: 40px"
          >
            <span class="text-white">CCIS GUIDE</span>
          </a>
          <p>
            website accessed by QR code provides CCIS guide to reach the location of any faculty member or administration office by performing a quick search .
          </p>
        
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
          <h3 class="text-primary mb-4">Get In Touch</h3>
          <div class="d-flex">
            <h4 class="fa fa-map-marker-alt text-primary"></h4>
            <div class="pl-3">
              <h5 class="text-white">Address</h5>
              <p>College of Computer and Information Sciences at imam ibn muhammad university, Riyadh</p>
            </div>
          </div>
          <div class="d-flex">
            <h4 class="fa fa-envelope text-primary"></h4>
            <div class="pl-3">
              <h5 class="text-white">Email</h5>
              <p>ccis@imamu.edu.sa</p>
            </div>
          </div>
          <div class="d-flex">
            <div class="pl-3">
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
          <h3 class="text-primary mb-4">Quick Links</h3>
          <div class="d-flex flex-column justify-content-start">
          <a class="text-white mb-2" href="Home.php"
              ><i class="fa fa-angle-right mr-2"></i>Home</a
            >
            <a class="text-white mb-2" href="about.php"
              ><i class="fa fa-angle-right mr-2"></i>About Us</a
            >
            <a class="text-white mb-2" href="Login.php"
              ><i class="fa fa-angle-right mr-2"></i>Staff login</a
            >
            <a class="text-white mb-2" href="formStudent.php"
              ><i class="fa fa-angle-right mr-2"></i>Student/Visitor</a
            >
            <a class="text-white mb-2" href="Request.php"
              ><i class="fa fa-angle-right mr-2"></i>Help</a
            >
            
          </div>
        </div>
        
      <div
        class="container-fluid pt-5"
        style="border-top: 1px solid rgba(23, 162, 184, 0.2) ;"
      >
        <p class="m-0 text-center text-white">
         
          
        </p>
      </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary p-3 back-to-top"
      ><i class="fa fa-angle-double-up"></i
    ></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="New fplder/easing.min.js"></script>
    <script src="New folder/owlcarousel/owl.carousel.min.js"></script>
    <script src="New folder/isotope.pkgd.min.js"></script>
    <script src="lightbox.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="New folder/jqBootstrapValidation.min.js"></script>
    <script src="New foledr/contact.js"></script>

    <!-- Template Javascript -->
    <script src="New folder/main.js"></script>
    
   

  </body>
</html>




