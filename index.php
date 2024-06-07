<?php
include_once "includes/dbcon.php";

session_start();

if (isset($_POST['btn_login'])){


  $useremail = $_POST['txt_email'];
  $password = $_POST['txt_password'];

  $select = $pdo-> prepare("select * from tbl_user where useremail='$useremail' AND userpassword='$password'");
  $select ->execute();

  $row = $select->fetch(PDO::FETCH_ASSOC);

  if(is_array($row)){

    if($row['useremail'] == $useremail AND $row['userpassword'] == $password AND $row['role'] == "Admin"){

      $_SESSION['status']="Login Successful by Admin!!!";
      $_SESSION['status_code']="success";

      header('refresh:1; homeadmin.php');

      $_SESSION['userid']=$row['userid'];
      $_SESSION['username']=$row['username'];
      $_SESSION['useremail']=$row['useremail'];
      $_SESSION['role']=$row['role'];

    }elseif($row['useremail'] == $useremail AND $row['userpassword'] == $password AND $row['role'] == "User"){

      $_SESSION['status']="Login Successful by User!!!";
      $_SESSION['status_code']="success";

      header('refresh:1; homeuser.php');

      $_SESSION['userid']=$row['userid'];
      $_SESSION['username']=$row['username'];
      $_SESSION['useremail']=$row['useremail'];
      $_SESSION['role']=$row['role'];

    }
    }else{

      $_SESSION['status']="Wrong Email or Password";
      $_SESSION['status_code']="error";
      //echo $success = 'Wrong email or password';
    }
  }


?>



<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='utf-8'>
  <meta content='width=device-width, initial-scale=1.0' name='viewport'>

  <title>Pages / Login -Inventory Tracking Stystem</title>
  <meta content='' name='description'>
  <meta content='' name='keywords'>

  <!-- Favicons -->
   <link href='assets/img/ugilogo.jfif' rel='icon'>
   <link href='assets/img/ugilogo.jfif' rel='apple-touch-icon'>

  <!-- Google Fonts -->
  <link href='https://fonts.gstatic.com' rel='preconnect'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i' rel='stylesheet'>

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

  <!-- Vendor CSS Files -->
  <link href='assets/vendor/bootstrap/bootstrap.min.css' rel='stylesheet'>
  <link href='assets/vendor/bootstrap-icons/bootstrap-icons.css' rel='stylesheet'>
  <link href='assets/vendor/bootstrap-icons/bootstrap-icons.min.css' rel='stylesheet'>
  <link href='assets/vendor/boxicons/css/boxicons.min.css' rel='stylesheet'>
  <link href='assets/vendor/quill/quill.snow.css' rel='stylesheet'>
  <link href='assets/vendor/quill/quill.bubble.css' rel='stylesheet'>
  <link href='assets/vendor/remixicon/remixicon.css' rel='stylesheet'>
  <link href='assets/vendor/simple-datatables/style.css' rel='stylesheet'>

  <!-- Template Main CSS File -->
  <link href='assets/css/style.css' rel='stylesheet'>

 
</head>

<body>



  <main>
    <div class='container'>

      <section class='section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4'>
        <div class='container'>
          <div class='row justify-content-center'>
            <div class='col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center'>

              <div class='d-flex justify-content-center py-4'>
                <a href='index.html' class='logo d-flex align-items-center w-auto'>
                  <!-- <img src='assets/img/ugilogo.jfif' style='width:50px;' alt='> -->
                  <span class='d-none d-lg-block'>Tracking System</span>
                </a>
              </div><!-- End Logo -->

              <div class='card mb-3'>

                <div class='card-body'>

                  <div class='pt-4 pb-2'>
                    <h5 class='card-title text-center pb-0 fs-4'>Login to Your Account</h5>
                    <p class='text-center small'>Enter your username & password to login</p>
                  </div>

                  <form class='row g-3 needs-validation' action='' method='post'>

                    <div class='col-12'>
                        <label for='yourEmail' class='form-label'>Your Email</label>
                        <input type='email' name="txt_email" Placeholder='Enter email' class='form-control' id='yourEmail' required>
                        <div class='invalid-feedback'>Please enter a valid Email adddress!</div>
                    </div>

                    <div class='col-12'>
                      <label for='yourPassword' class='form-label'>Password</label>
                      <input type='password' name='txt_password' Placeholder='Enter Password' class='form-control' id='yourPassword' required>
                      <div class='invalid-feedback'>Please enter your password!</div>
                    </div>

                  
                    <div class='col-12'>
                      <button class='btn btn-primary w-100' name="btn_login" type='submit'>Login</button>
                    </div>
                    <p class="m-1">
        <!-- <a href="forgot-password.html" class="">I forgot my password</a>
      </p> -->
                  </form>

                </div>
              </div>

              <div class='credits'>
               
                Developed by Garvita, Bhawana, Deepesh & Dipendra
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main> <!-- End #main -->



              
<?php
  if(isset($_SESSION['status']) && $_SESSION['status']!=""){

    ?>
    <script>

$(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 5000
    });


      Toast.fire({
        icon: '<?php echo $_SESSION['status_code'] ?>',
        title: '<?php echo $_SESSION['status'] ?>'
      })
    });


    </script>

    <?php
    unset($_SESSION['status']);
  }
  ?>





  <a href='#' class='back-to-top d-flex align-items-center justify-content-center'><i class='bi bi-arrow-up-short'></i></a>

  <!-- Vendor JS Files -->
  <script src='assets/vendor/apexcharts/apexcharts.min.js'></script>
  <script src='assets/vendor/bootstrap/js/bootstrap.bundle.min.js'></script>
  <script src='assets/vendor/chart.js/chart.umd.js'></script>
  <script src='assets/vendor/echarts/echarts.min.js'></script>
  <script src='assets/vendor/quill/quill.min.js'></script>
  <script src='assets/vendor/simple-datatables/simple-datatables.js'></script>
  <script src='assets/vendor/tinymce/tinymce.min.js'></script>
  <script src='assets/vendor/php-email-form/validate.js'></script>

  <!-- Template Main JS File -->
  <script src='assets/js/main.js'></script>

</body>

</html>   


 <!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
                
<?php
  if(isset($_SESSION['status']) && $_SESSION['status']!=""){

    ?>
    <script>

$(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 5000
    });


      Toast.fire({
        icon: '<?php echo $_SESSION['status_code'] ?>',
        title: '<?php echo $_SESSION['status'] ?>'
      })
    });


    </script>

    <?php
    unset($_SESSION['status']);
  }
  ?>
  




