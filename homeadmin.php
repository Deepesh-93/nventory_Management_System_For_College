<?php

include_once "includes/dbcon.php";
session_start();

if($_SESSION['useremail']==""){

  header('location:../index.php');
}

// include_once "header.php"

?>


<body>

 <!-- ======= Header ======= -->
 
 <?php include 'includes/header.php'; ?>
 
 <!-- End Header -->




<!--   ************************  Main Page ********************** -->

  <main id='main' class='main'>

   <div class='pagetitle'>
      <h1>Admin Dashboard</h1>
      <nav>
        <ol class='breadcrumb'>
          <li class='breadcrumb-item'><a href='homeadmin.php'>Home</a></li>
          <li class='breadcrumb-item active'>Dashboard</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
  
<?php 
 
  $select = $pdo->prepare("select * from tbl_user where userid = ".$_SESSION['userid']);
  $select->execute();

  while ($row = $select->fetch(PDO::FETCH_OBJ)) {

echo"
    
    <section class='section profile'>
        <div class='row'>
          <div class='col-xl-4'>

            <div class='card'>
              <div class='card-body profile-card pt-4 d-flex flex-column align-items-center'>

               <h2>
                   ".$row->username ."
                </h2>
                <h3>
                  ".$row->role."
                </h3>
                <div class='social-links mt-2'>
                  <a href=". $row->twitter." class='twitter'><i class='bi bi-twitter'></i></a>
                  <a href=". $row->facebook." class='facebook'><i class='bi bi-facebook'></i></a>
                  <a href=". $row->insta." class='instagram'><i class='bi bi-instagram'></i></a>
                  <a href=". $row->linkedin." class='linkedin'><i class='bi bi-linkedin'></i></a>
                </div>
              </div>
            </div>

          </div>

          <div class='col-xl-8'>

            <div class='card'>
              <div class='card-body pt-3'>
                <!-- Bordered Tabs -->
                <ul class='nav nav-tabs nav-tabs-bordered'>

                  <li class='nav-item'>
                    <button class='nav-link active' data-bs-toggle='tab'
                      data-bs-target='#profile-overview'>Overview</button>
                  </li>


                </ul>
                <div class='tab-content pt-2'>

                  <div class='tab-pane fade show active profile-overview' id='profile-overview'>
                    <h5 class='card-title'>About</h5><br><br><br>
                    <p class='large fst-italic'>
                       ". $row->about ."
                    </p>

                    <hr>
                    <h5 class='card-title'>Profile Details</h5><br><br><br>

                    <div class='row'>
                      <div class='col-lg-3 col-md-4 label '>Full Name</div>
                      <div class='col-lg-9 col-md-8'>
                         ". $row->username ."
                      </div>
                    </div>

                    <div class='row'>
                      <div class='col-lg-3 col-md-4 label'>Position</div>
                      <div class='col-lg-9 col-md-8'>
                        ". $row->role ."
                      </div>
                    </div>

                    <div class='row'>
                      <div class='col-lg-3 col-md-4 label'>Address</div>
                      <div class='col-lg-9 col-md-8'>
                        ". $row->address ."
                      </div>
                    </div>

                    <div class='row'>
                      <div class='col-lg-3 col-md-4 label'>Phone</div>
                      <div class='col-lg-9 col-md-8'>
                       ". $row->number ."
                      </div>
                    </div>

                    <div class='row'>
                      <div class='col-lg-3 col-md-4 label'>Email</div>
                      <div class='col-lg-9 col-md-8'>
                       ". $row->useremail ."
                      </div>
                    </div>

                  </div>

                </div>
</section>

";
  }
?>
  
  </main><!-- End #main -->

      
  <!-- ======= Footer ======= -->
 
  <?php include 'includes/footer.php'; ?>
 
  <!-- End Footer -->

  <a href='#' class='back-to-top d-flex align-items-center justify-content-center'><i class='bi bi-arrow-up-short'></i></a>

 

</body>

</html>