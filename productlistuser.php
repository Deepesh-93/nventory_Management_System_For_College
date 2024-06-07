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

    <div class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5 class="m-0">Product List:</h5>
            </div>
            <div class="card-body">

              <table class="table table-striped table-hover" id="tbl_product">

                <thead>
                  <tr>
                    <td>Barcode</td>
                    <td>Product</td>
                    <td>Category</td>
                   
                    <td>Description</td>
                    <td>Quantity</td>
                    
                    <td>Price</td>
                    <td>Image</td>
                    <td>ActionIcons</td>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $select = $pdo->prepare("select * from tbl_product order by pid asc");
                  $select->execute();
                  while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                    echo '
                      <tr>
                      <td>' . $row->barcode . '</td>
                      <td>' . $row->product . '</td>
                      <td>' . $row->category . '</td>
                     
                      <td>' . $row->description . '</td>
                      <td>' . $row->stock . '</td>

                      
                      <td>' . $row->saleprice . '</td>
                      <td><image src="productimages/' . $row->image . '" class="img-rounded" width="40px" height="40px/"></td>
                      
                      <td>
                      <div class="btn-group">
              
                      <a href="viewproduct.php?id=' . $row->pid . '" class="btn btn-warning btn-xs" role="button"><span class="fa fa-eye" style="color:#fffff" data-toggle="tooltip" title="View Product"></span></a>

                      </div>
                      
                      </td>
                      

                      


                      </tr>';
                  }

                  ?>

                </tbody>

              </table>


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

<script>
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>

<script>
  $(document).ready(function() {
    $('.btndelete').click(function() {

      var tdh = $(this);
      var id = $(this).attr("id");


      

      $.ajax({

        url: 'productdelete.php',
        type: 'post',
        data: {
          pidd: id
        },
        success: function(data) {
          tdh.parents('tr').hide();
        }
      });
    });
  });
</script>