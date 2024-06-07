<?php 

include_once "includes/dbcon.php";
session_start();

if ($_SESSION['useremail'] == "") {

  header('location:../index.php');
}


if($_SESSION['role']=="Admin"){

    include_once "includes/header.php";
  
  }else{
  
    include_once "includes/headeruser.php";
  };

include 'UI/barcode/barcode128.php';


?>


  <!--   ************************  Products Page ********************** -->

  <main id="main" class="main">

    <!-- <div class="pagetitle">
      <h1>Products</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Product List</li>
        </ol>
      </nav>
    </div> -->
    <!-- End Page Title -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card-info card-outline">
                        <div class="card-header">
                            <h5 class="m-0">View Product</h5>
                        </div>
                        <div class="card-body">


                            <?php
                            $id = $_GET['id'];

                            $select = $pdo->prepare("select * from tbl_product where pid = $id");
                            $select->execute();

                            while ($row = $select->fetch(PDO::FETCH_OBJ)) {


                                echo '
                        <div class="row">
                                <div class="col-md-6">

                                    <ul class="list-group">

                                        <center>
                                            <p class="list-group-item list-group-item-info"><b>PRODUCT DETAILS</b></p>
                                        </center>

                                        <li class="list-group-item"><b>Barcode<span class="badge badge-light float-right">'.bar128($row->barcode ).  '</span></li>
                                        <li class="list-group-item">Product Name <span class="badge badge-warning float-right">' . $row->product . '</span></li>
                                        <li class="list-group-item">Category<span class="badge badge-success float-right">' . $row->category . '</span></li>
                                        <li class="list-group-item">Description <span class="badge badge-primary float-right">' . $row->description . '</span></li>
                                        <li class="list-group-item">Quantity<span class="badge badge-danger float-right">' . $row->stock . '</span></li>
                                        <li class="list-group-item">Price<span class="badge badge-dark float-right">' . $row->saleprice . '</span></li>

                                        <li class="list-group-item"><b>Product Profit</b> <span class="badge badge-success float-right">' . ($row->saleprice - $row->purchaseprice) . '</span></li>
                                    </ul>

                                </div>
                                

                                <div class="col-md-6">

                                    <ul class="list-group">

                                        <center>
                                       <p class="list-group-item list-group-item-info"><b>PRODUCT IMAGE</b></p>
                                        </center>

                                        <img src="productimages/'. $row->image .'" class=""/></img>

                                    </ul>

                                </div>

                            </div>

                        ';
                            }

                            ?>

                        </div>
                    </div>
                
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->



    

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