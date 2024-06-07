
  <!-- Mysql connection  -->
  <?php include 'includes/dbcon.php'; ?>

  <!-- ======= Header ======= -->

  <?php include 'includes/header.php'; ?>

  <!-- End Header -->

  <!-- ======= Sidebar ======= -->

  <?php include 'includes/sidebar.php'; ?>

  <!--   End Sidebar -->

  <?php 
  if (isset($_GET['status'])) { 
    echo "<script>alert('".$_GET['status']."')</script>";
  } 
?>

  <?php

// session_start();
// $email = $_SESSION['member_email'];
include "includes/dbcon.php";


   

  echo"

     <!--   Main page -->

  <main id='main' class='main'>

      <div class='pagetitle'>
        <h1>Profile</h1>
        <nav>
          <ol class='breadcrumb'>
            <li class='breadcrumb-item'><a href='home.php'>Home</a></li>
            <li class='breadcrumb-item'>Users</li>
            <li class='breadcrumb-item active'>Profile</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

      <section class='section profile'>
        <div class='row'>
          <div class='col-xl-4'>

            <div class='card'>
              <div class='card-body profile-card pt-4 d-flex flex-column align-items-center'>

                <!-- <img src='' alt='Profile' class='rounded-circle'> -->
                <img src='data:image/jpeg;base64,".base64_encode($row['member_image'])."' alt= 'image not found' class='rounded-circle' >
                <h2>
                   $row[member_firstname]
                </h2>
                <h3>
                  $row[member_position];
                </h3>
                <div class='social-links mt-2'>
                  <a href=' $row[member_twitter_id]' class='twitter'><i class='bi bi-twitter'></i></a>
                  <a href=' $row[member_facebook_id]' class='facebook'><i class='bi bi-facebook'></i></a>
                  <a href=' $row[member_insta_id]' class='instagram'><i class='bi bi-instagram'></i></a>
                  <a href=' $row[member_linkedin_id]' class='linkedin'><i class='bi bi-linkedin'></i></a>
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

                  <li class='nav-item'>
                    <button class='nav-link' data-bs-toggle='tab' data-bs-target='#profile-edit'>Edit Profile</button>
                  </li>

                

                  <li class='nav-item'>
                    <button class='nav-link' data-bs-toggle='tab' data-bs-target='#profile-change-password'>Change
                      Password</button>
                  </li>

                </ul>
                <div class='tab-content pt-2'>

                  <div class='tab-pane fade show active profile-overview' id='profile-overview'>
                    <h5 class='card-title'>About</h5>
                    <p class='small fst-italic'>
                       $row[about] 
                    </p>

                    <h5 class='card-title'>Profile Details</h5>

                    <div class='row'>
                      <div class='col-lg-3 col-md-4 label '>Full Name</div>
                      <div class='col-lg-9 col-md-8'>
                         $row[member_fullname] 
                      </div>
                    </div>

                    <div class='row'>
                      <div class='col-lg-3 col-md-4 label'>Position</div>
                      <div class='col-lg-9 col-md-8'>
                         $row[member_position] 
                      </div>
                    </div>

                    <div class='row'>
                      <div class='col-lg-3 col-md-4 label'>Address</div>
                      <div class='col-lg-9 col-md-8'>
                         $row[member_address] 
                      </div>
                    </div>

                    <div class='row'>
                      <div class='col-lg-3 col-md-4 label'>Phone</div>
                      <div class='col-lg-9 col-md-8'>
                        $row[member_phone]
                      </div>
                    </div>

                    <div class='row'>
                      <div class='col-lg-3 col-md-4 label'>Email</div>
                      <div class='col-lg-9 col-md-8'>
                        $row[member_email]
                      </div>
                    </div>

                  </div>

                 

                  <div class='tab-pane fade profile-edit pt-3' id='profile-edit'>

                    <!-- Profile Edit Form -->




                    <form action='php/update_profile_action.php' id='profileForm' method='POST'>
                      
                      <div class='row mb-3'>
                        <label for='profileImage' class='col-md-4 col-lg-3 col-form-label'>Profile Image</label>
                        <img src='data:image/jpeg;base64,".base64_encode($row['member_image'])."' alt= 'image not found' class='rounded-circle' >
                        <div class='col-md-8 col-lg-9'>
                      
                          <div class='pt-2'>
                            <!-- <a  name='newProfileImage' class='btn btn-primary btn-sm' title='Upload new profile image'><i
                                class='bi bi-upload'></i></a>
                            <a  name='deleteImage' class='btn btn-danger btn-sm' title='Remove my profile image'><i
                                class='bi bi-trash'></i></a> -->
                          </div>
                        </div>
                      </div>

                      <div class='row mb-3'>
                        <label for='fullName' class='col-md-4 col-lg-3 col-form-label'>Full Name</label>
                        <div class='col-md-8 col-lg-9'>
                          <input name='fullName' type='text' class='form-control' id='fullName'
                          value='$row[member_fullname]'>
                        </div>
                      </div>

                      <div class='row mb-3'>
                        <label for='about' class='col-md-4 col-lg-3 col-form-label'>About</label>
                        <div class='col-md-8 col-lg-9'>
                          <textarea name='about' class='form-control' id='about'
                            style='height: 100px'>$row[about]</textarea>
                        </div>
                      </div>

                      <div class='row mb-3'>
                        <label for='Organization' class='col-md-4 col-lg-3 col-form-label'>Position</label>
                        <div class='col-md-8 col-lg-9'>
                          <input name='position' type='text' class='form-control' id='company'
                            value='$row[member_position]'>
                        </div>
                      </div>

                      <div class='row mb-3'>
                        <label for='Address' class='col-md-4 col-lg-3 col-form-label'>Address</label>
                        <div class='col-md-8 col-lg-9'>
                          <input name='address' type='text' class='form-control' id='Address'
                            value='$row[member_address]'>
                        </div>
                      </div>

                      <div class='row mb-3'>
                        <label for='Phone' class='col-md-4 col-lg-3 col-form-label'>Phone</label>
                        <div class='col-md-8 col-lg-9'>
                          <input name='phone' type='text' class='form-control' id='Phone'
                            value='$row[member_phone]'>
                        </div>
                      </div>

                      <div class='row mb-3'>
                        <label for='Email' class='col-md-4 col-lg-3 col-form-label'>Email</label>
                        <div class='col-md-8 col-lg-9'>
                          <input name='email' type='email' class='form-control' id='Email'
                            value='$row[member_email]'>
                        </div>
                      </div>

                      <div class='row mb-3'>
                        <label for='Twitter' class='col-md-4 col-lg-3 col-form-label'>Twitter Profile</label>
                        <div class='col-md-8 col-lg-9'>
                          <input name='twitter' type='text' class='form-control' id='Twitter'
                            value='$row[member_twitter_id]'>
                        </div>
                      </div>

                      <div class='row mb-3'>
                        <label for='Facebook' class='col-md-4 col-lg-3 col-form-label'>Facebook Profile</label>
                        <div class='col-md-8 col-lg-9'>
                          <input name='facebook' type='text' class='form-control' id='Facebook'
                            value='$row[member_facebook_id]'>
                        </div>
                      </div>

                      <div class='row mb-3'>
                        <label for='Instagram' class='col-md-4 col-lg-3 col-form-label'>Instagram Profile</label>
                        <div class='col-md-8 col-lg-9'>
                          <input name='instagram' type='text' class='form-control' id='Instagram'
                            value='$row[member_insta_id]'>
                        </div>
                      </div>

                      <div class='row mb-3'>
                        <label for='Linkedin' class='col-md-4 col-lg-3 col-form-label'>Linkedin Profile</label>
                        <div class='col-md-8 col-lg-9'>
                          <input name='linkedin' type='text' class='form-control' id='Linkedin'
                            value='$row[member_linkedin_id]'>
                        </div>
                      </div>

                      <div class='text-center'>
                        <button type='submit' class='btn btn-primary'>Save Changes</button>
                      </div>
                    </form>

                    <!-- End Profile Edit Form -->

                  </div>

                 

                  

                  <div class='tab-pane fade pt-3' id='profile-change-password'>
                    <!-- Change Password Form -->
                    <form action='php/update_password_action.php' method='post'>

                      <div class='row mb-3'>
                        <label for='currentPassword' class='col-md-4 col-lg-3 col-form-label'>Current Password</label>
                        <div class='col-md-8 col-lg-9'>
                          <input name='password' type='password' class='form-control' id='currentPassword'>
                        </div>
                      </div>

                      <div class='row mb-3'>
                        <label for='newPassword' class='col-md-4 col-lg-3 col-form-label'>New Password</label>
                        <div class='col-md-8 col-lg-9'>
                          <input name='newpassword' type='password' class='form-control' id='newPassword'>
                        </div>
                      </div>

                      <div class='row mb-3'>
                        <label for='renewPassword' class='col-md-4 col-lg-3 col-form-label'>Re-enter New Password</label>
                        <div class='col-md-8 col-lg-9'>
                          <input name='renewpassword' type='password' class='form-control' id='renewPassword'>
                        </div>
                      </div>

                      <div class='text-center'>
                        <button type='submit' class='btn btn-primary'>Change Password</button>
                      </div>
                    </form><!-- End Change Password Form -->

                  </div>

                </div><!-- End Bordered Tabs -->

              </div>
            </div>

          </div>
        </div>
      </section>

    </main>
    
    <!-- End #main -->
" ?>

    <?php
  // }
  ?>

  <!-- ======= Footer ======= -->

  <?php include 'includes/footer.php'; ?>


  <!-- End Footer -->

  <a href='#' class='back-to-top d-flex align-items-center justify-content-center'><i
      class='bi bi-arrow-up-short'></i></a>

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