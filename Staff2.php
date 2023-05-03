<?php
include("Connection.php");
?>

<!-- Connecting Search -->
<?php 
  if(isset($_POST['searchdata']))
  {
    $Professor = array(
      'Professor' => $_POST['Professor'],
      'Officename' => $_POST['Officename']
  );
    $query = "SELECT * FROM offices WHERE CONCAT(First_Name, Office_Name) LIKE '%{$Professor['Professor']}%{$Professor['Officename']}%'";
    $data = mysqli_query($conn, $query);

    $result = mysqli_fetch_assoc($data);

  }

    ?>

<!-- End Search -->

<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">

  <!--connecting logout -->
<?php 
  if(isset($_POST['logout']))
  {
    session_destroy();
    header("location: Home.php");
  }
?>
  <!--end logout -->

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
            
<!--  Searchbar begin -->
  <div class="containers">
      <div class=" mx-auto  ">
      
      <form class="d-flex" role="search" action="" method="POST">
          <input id="search" name="Professor" class="form-control me-2" type="text" placeholder="Search" aria-label="Search" autocomplete="off" required 
         >
          <input class="btn btn-outline-success" type="submit" value="search" name="searchdata">
          
          
        </form>
       
          <div class="input-group">
            <div class="input-group-append">
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
    <!-- Navbar End -->

      <!-- Header Start -->
      <div class="container-fluid bg-primary mb-5">
        <div
          class="d-flex flex-column align-items-center justify-content-center"
          style="min-height: 400px"
        >
        <form action="" method="POST">
          <h3 class="display-3 font-weight-bold text-white">Welcome To Imam University</h3>
          <div class="d-inline-flex text-white">
        
            <p class="m-0"></p>
          </div>
        </div>
      </div>
      <!-- Header End -->

     <!-- Contact Start -->
     <div class="container-fluid pt-5">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Information</span>
          </p>
          
        </div>
        <div class="row" >
          <div class="col-lg-7 mb-5" >
            <div class="contact-form" >
              <div id="success"></div>
              <form name="sentMessage" id="contactForm" novalidate="novalidate">
                <div class="control-group">
                  <div id="test">
                  <!--Professor name textfeild-->
                  
                  <tr>Professors Name</tr>
                  <input 
                  type="text" 
                  name="Professor"
                  class ="form-control" 
                  id="name" 
                  placeholder="Search for a professor..." 
                  data-validation-opening-message=""
                  value="<?php if(isset($_POST['searchdata'])){echo $result['First_Name']; }  ?>"/>

                  <!--Office name textfeild-->
          <tr>Office Name</tr>
          <div class="control-group">
                  <input
                    type="text"
                    name="Officename"
                    class="form-control"
                    id="floor"
                    placeholder="Search for office..."
                    data-validation-opening-message="t"
                    value="<?php if(isset($_POST['searchdata'])){echo $result['Office_Name']; } ?>"
                    >


                  <!--Office number textfeild-->
                </div>
                <tr>Office Number</tr>
                <div class="control-group">
                  <input
                    type="text"
                    name="Officenumber"
                    class="form-control"
                    id="office"
                    data-validation-opening-message=""
                    value="<?php if(isset($_POST['searchdata'])){echo $result['Office_Number']; } ?>"
                    >

                  
                  <!--Office floor textfeild-->
                  <tr>Floor</tr>
                </div>
                <div class="control-group">
                  <input
                    type="text"
                    name="Floornumber"
                    class="form-control"
                    id="floor"
                    data-validation-opening-message="t"
                    value="<?php if(isset($_POST['searchdata'])){echo $result['Floor_Number']; }?>"
                    >
                    
                  <!--Maintenance textfeild-->
                </div>
                
               <style>

               </style>

                <tr>Maintenance</tr>
                <div class="control-group">
                  <input
                  type="text"
                    class="form-control"
                    name="Maintenance"
                    id="maintenance"
                    data-validation-opening-message=""
                    value="<?php if(isset($_POST['searchdata'])){echo $result['Maintenance']; }?>"
                    >

                    <p class="help-block text-danger"></p>
            <title>location</title>

            <style>
            h1{
              text-align:50;
            }
          </style>
          
          </div>
          </div>
                </div>
                <div>
                  <!-- search button -->
                  <input
                    class="btn btn-primary py-2 px-4"
                    type="submit"
                    id="EditButton"
                    name="searchdata"
                    value = "Search"
                  >
                  
                <!--  Edit button -->
                
                <input
                class="btn btn-primary py-2 px-4"
                type="Submit"
                value = "Update"
                name = "editdata"
              >
                    
                 <!--  Delete button -->
                  <input
                  class="btn btn-primary py-2 px-4"
                  type="Submit"
                  name="deletedata"
                  value = "Delete"
                  id="DelelteButton"
                  onclick="return checkdelete()"
                >
                <!-- Print button -->
                <input
                class="btn btn-primary py-2 px-4"
                type="Submit"
                value = "Print"
                name="printdata"
                id="PrintButton"
                onclick= "printPageArea('test')"
              >
                <!-- Save button -->
              <input
              class="btn btn-primary py-2 px-4"
              type="Submit"
              name="savedata"
              Value="Save"
              id="saveButton"
              onclick="window.print"
            >
            <!-- Cancel button -->
            <input
            class="btn btn-primary py-2 px-4"
            type="reset"
            id=" CancelButton"
            value = "Clear"
          >
            <!-- end Cancel button -->
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-5 mb-5">
          <p><iframe width="100%" src="https://viewer.mapme.com/4cab67f9-1ae0-4328-b9b9-c0c5e9909c16" frameborder="0" allowfullscreen allow="fullscreen; geolocation" scrolling="no" style="min-height: 90vh; max-height: 90vh; border: 1px solid lightgrey; border-radius: 2px;"></iframe>
              <a class="icon-link icon-link-hover" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="#">
                <svg class="bi" aria-hidden="true">
              
                </svg>
              </a> 
            </p>
          </div>
          </div>
            </div>
          </div>
         
        </div>
      </div>
      </div>
      </div>
    </form>
    <!-- Contact End -->


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
            <a class="text-white mb-2" href="fromStudent.php"
              ><i class="fa fa-angle-right mr-2"></i>Student/Visitor</a
            >
            <a class="text-white mb-2" href="Request.php"
              ><i class="fa fa-angle-right mr-2"></i>Help</a
            >
            <style>
              div.header{
              display: flex;
              justify-content: space-between;
              float: right;
              width: 100%;
              margin-right: 0px;
              font-family: Arial, Helvetica, sans-serif;
              font-size: 15px;
              height: 100px;
              overflow:auto;
              opacity: 80%;
              }
            </style>
            <div class="header">
              <form method="POST">
            <button name="logout">LOG OUT</button>
            </form>
          </div>
          </div>
          

        </div>
      <div
        class="container-fluid pt-5"
        style="border-top: 1px solid rgba(23, 162, 184, 0.2) ;"
      >
        
      
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

<!-- Connecting Print -->

<script>
    function printPageArea(areaID){
      var printContent = document.getElementById(areaID).innerHTML;
      var originalContent = document.body.innerHTML;
      document.body.innerHTML = printContent;
      window.print();
      document.body.innerHTML = originalContent;
    }

  </script>

<!-- End Print -->

<script>
  function checkdelete(){
    return confirm('Are you sure you want to delete this record?');
  }
</script>

<!-- Save button -->
<?php 
  if(isset($_POST['savedata'])){
    $Floornumber = $_POST['Floornumber'];
    $Officename = $_POST['Officename'];
    $professor = $_POST['Professor'];
    $Maintenance = $_POST['Maintenance'];
    $Officenumber = $_POST['Officenumber'];

    $query = "INSERT INTO offices (Floor_Number, Office_Name, First_Name,  Maintenance, Office_Number) 
    VALUES ('$Floornumber','$Officename','$professor','$Maintenance','$Officenumber')";

  $data = mysqli_query($conn, $query);

   if($data){
    echo "<script> alert ('Data saved into Database')</script>";
   }
   else{
    echo "<script> alert ('Failed to save data')</script>";
   }
  }
?>
<!-- Delete button -->
<?php 
  if(isset($_POST['deletedata']))
  {
    $Professor = $_POST['Professor'];
    $query = "DELETE FROM offices WHERE First_Name = '$Professor' ";
    $data = mysqli_query($conn, $query);

    if($data){
      echo "<script> alert ('Record deleted')</script>";
    }else{
      echo "<script> alert ('Failed to deleted')</script>";
    }
  }
?>

<!--Modify button-->
<?php 
  if(isset($_POST['editdata']))
  {
    $Floornumber = $_POST['Floornumber'];
    $Officename = $_POST['Officename'];
    $professor = $_POST['Professor'];
    $Maintenance = $_POST['Maintenance'];
    $Officenumber = $_POST['Officenumber'];

    $query = "UPDATE offices SET Floor_Number ='$Floornumber', Office_Name ='$Officename', 
    Maintenance='$Maintenance', Office_Number='$Officenumber' WHERE First_Name='$professor'";

$data = mysqli_query($conn, $query);

if($data){
 echo "<script> alert ('Record updated')</script>";
}
else{
 echo "<script> alert ('Failed to update')</script>";
}

  }
    ?>
