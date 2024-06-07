<?php 

include_once "includes/dbcon.php";
session_start();

if ($_SESSION['useremail'] == "") {

  header('location:../index.php');
}


include_once "includes/header.php";




?>


  <!--   ************************  Products Page ********************** -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Products</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Product List</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->




    

  </main>


  <!-- ======= Footer ======= -->

  <?php include "includes/footer.php"; ?>

  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

      <?php
    if (isset($_SESSION['status']) && $_SESSION['status'] != "") {

    ?>
        <script>
            Swal.fire({
                icon: '<?php echo $_SESSION['status_code'] ?>',
                title: '<?php echo $_SESSION['status'] ?>'
            })
        </script>

    <?php
        unset($_SESSION['status']);
    }
    ?>


    <script>
        $(document).ready(function() {
            $('#tbl_product').DataTable();
        });
    </script>