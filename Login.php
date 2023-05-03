<?php
  require("loginConnect.php");

?>
<?php
session_start();

if(isset($_POST['submit'])) {

    $max_login_attempts = 3;

    $time_limit = 30;
    

    if(isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= $max_login_attempts) {

        if(isset($_SESSION['login_time']) && time() - $_SESSION['login_time'] < $time_limit) {
            $error_message = "You have exceeded the maximum number of login attempts. Please try again later.";
        } else {

            $_SESSION['login_attempts'] = 1;
            $_SESSION['login_time'] = time();
            $error_message = "You have exceeded the maximum number of login attempts. Please try again after $time_limit seconds.";
        }
    } else {

      //FROM login in database phpmyadmin
        $query = "SELECT * FROM users WHERE email = '$_POST[Email]' AND password = '$_POST[Password]'";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) == 1) {

            $_SESSION['login_attempts'] = 0;
            unset($_SESSION['login_time']);

            $_SESSION['loginId'] = $_POST['Email'];
            header("location: Staff2.php");
            exit;
        } else {

            if(isset($_SESSION['login_attempts'])) {
                $_SESSION['login_attempts']++;
            } else {
                $_SESSION['login_attempts'] = 1;
            }
            $error_message = "Incorrect Email or Password";
        }
    }
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
<style>
 .error{
  color: red;
  padding: 5px;
  margin-bottom: 10px;
  }
  </style>
           <!-- login begins -->
   
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
  <h2 >Login</h2>
  <form> 
    <?php if(isset($error_message)) { ?>
             <div class="error" ><?php echo $error_message; ?></div>
              <?php } ?>

    <div class="form-group">
      <input type="email" class="form-control border-0 py-4" placeholder="Email Address" required="required" name="Email">
    </div>
    <div class="form-group">
      <input type="password" class="form-control border-0 py-4" placeholder="Password" required="required" name="Password">
    </div>
    <a href="forgot.php" id="forgot">Forgot Your Password?</a>
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

<input class="btn btn-secondary btn-block border-0 py-3" type="submit" value="Login" name="submit">  </form>
</div> 
                 <!-- login End -->
                 
                  </form>
                      
                    </button>
                    
                    
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
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    
   

  </body>
</html>
