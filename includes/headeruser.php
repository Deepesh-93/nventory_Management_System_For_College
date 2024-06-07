<?php 
include_once "includes/dbcon.php";

// session_start();



?>
<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='utf-8'>
  <meta content='width=device-width, initial-scale=1.0' name='viewport'>

  <title>Inventory Management Stystem</title>
  <meta content='' name='description'>
  <meta content='' name='keywords'>

  <!-- Favicons -->
   <link href='assets/img/ugilogo.jfif' rel='icon'>
   <link href='assets/img/ugilogo.jfif' rel='apple-touch-icon'>

  <!-- Google Fonts -->
  <link href='https://fonts.gstatic.com' rel='preconnect'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i' rel='stylesheet'>

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

   <!-- Font Awesome Icons -->
   <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

 
</head>

<body style='background:#f6f9ff;'><!-- ======= Header ======= -->
    <header id='header' class='header fixed-top d-flex align-items-center'>

      <div class='d-flex align-items-center justify-content-between'>
        <a href='home.php' class='logo d-flex align-items-center'>
          <img src='assets/img/ugilogo.jfif' alt=''>
          <span class='d-none d-lg-block'>IMS System</span>
        </a>
        <i class='bi bi-list toggle-sidebar-btn'></i>
      </div><!-- End Logo -->

      <nav class='header-nav ms-auto'>

      
        <ul class='d-flex align-items-center'>

          <li class='nav-item dropdown pe-3'>

          <a class='nav-link nav-profile d-flex align-items-center pe-0' href='#' data-bs-toggle='dropdown'>
          <!-- <img src='' alt='member-image'> -->
          
            <span class='d-none d-md-block dropdown-toggle ps-2'><?php echo $_SESSION['username']; ?></span>
          </a><!-- End Profile Iamge Icon -->

            <ul class='dropdown-menu dropdown-menu-end dropdown-menu-arrow profile'>
              <li class='dropdown-header'>
              <?php echo $_SESSION['username']; ?>
                
              </li>
              <li>
                <hr class='dropdown-divider'>
              </li>

              <li>
                <a class='dropdown-item d-flex align-items-center' href='users-profile.php'>
                  <i class='bi bi-person'></i>
                  <span>My Profile</span>
                </a>
              </li>
              <li>
                <hr class='dropdown-divider'>
              </li>

              <li>
                <a class='dropdown-item d-flex align-items-center' href='index.php'>
                  <i class='bi bi-box-arrow-right'></i>
                  <span>Sign Out</span>
                </a>
              </li>

            </ul><!-- End Profile Dropdown Items -->
          </li><!-- End Profile Nav -->

        </ul>

       
      </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->";


    <!-- ############# SIDEBAR ########## -->
    
    <aside id='sidebar' class='sidebar'>

    <ul class='sidebar-nav mt-3' id='sidebar-nav'>

      <li class='nav-item'>
        <a class='nav-link ' href='homeuser.php'>
          <i class="nav-icon bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->


      
      <ul class="nav  nav-sidebar flex-column" data-widget="treeview" role="menu">
             
      <li class="nav-item ">
          <a href="#" class="nav-link active">
          <i class="bi bi-grid"></i>
            <p>
              Products
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="productlistuser.php" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Product List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="addproduct.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
                <p>Add Products</p>
              </a>
            </li>
          </ul>
        </li>
    </ul><!-- End Products Nav -->
    

    <li class='nav-item'>
        <a class='nav-link ' href='department.php'>
          <i class='bi bi-grid'></i>
          <span>Department</span>
        </a>
      </li><!-- End Department Nav -->

    <li class='nav-item'>
        <a class='nav-link ' href='requestproductuser.php'>
          <i class='bi bi-grid'></i>
          <span>Request Product</span>
        </a>
      </li><!-- End Request Item Nav -->
    

     
      <ul class="nav  nav-sidebar flex-column" data-widget="treeview" role="menu">
         
         <li class="nav-item ">
               <a href="#" class="nav-link active">
               <i class="bi bi-grid"></i>
                 <p>
                   Transfer Product
                   <i class="right fas fa-angle-left"></i>
                 </p>
               </a>
               <ul class="nav nav-treeview">
                 <li class="nav-item">
                   <a href="transferproduct.php" class="nav-link active">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Generate Request</p>
                   </a>
                 </li>
                 <li class="nav-item">
                   <a href="transferlist.php" class="nav-link">
                   <i class="far fa-circle nav-icon"></i>
                     <p>Request List</p>
                   </a>
                 </li>
               </ul>
             </li>
         </ul>
<!-- </li> -->

      
    
    </ul>


  </aside><!--   End Sidebar -->
