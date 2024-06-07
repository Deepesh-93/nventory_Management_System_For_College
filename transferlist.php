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
      <h1>Transfer Product</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Request List</li>
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
              <h5 class="m-0">Request List</h5>
            </div>
            <div class="card-body">

              <table class="table table-striped table-hover" id="tbl_transfer">

                <thead>
                  <tr>
                    <!-- <td>Barcode</td> -->
                    <td>Transfer Product</td>
                    <td>From</td>
                   
                    <td>To</td>
                    <td>Quantity</td>
                    
                    <td>Requested By</td>
                    <td>Date</td>
                    <td>Reason</td>
                    <!-- <td>Status</td> -->
                    <td>ActionIcons</td>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $select = $pdo->prepare("select * from tbl_transfer order by transfer_id desc");
                  $select->execute();
                  while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                    echo '
                      <tr>
                    
                      <td>' . $row->product . '</td>
                      <td>' . $row->from_dept . '</td>
                      <td>' . $row->to_dept . '</td>
                      <td>' . $row->quantity . '</td>             
                      <td>' . $row->requested_by . '</td>
                      <td>' . $row->request_date . '</td>
                      <td>' . $row->reason . '</td>
                   
                      
                      <td>
                      <div class="btn-group">
                      
                     <button id="' . $row->transfer_id . '" class="btn btn-danger btn-xs btndelete"><span class="fa fa-trash" style="color:#ffffff" data-toggle="tooltip" title="Delete Pruduct"></span></button>
                      
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
    $('#tbl_transfer').DataTable();
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
          transfer_idd: id
        },
        success: function(data) {
          tdh.parents('tr').hide();
        }
      });
    });
  });
</script>