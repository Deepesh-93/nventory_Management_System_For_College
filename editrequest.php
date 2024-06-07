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
// include 'barcode/barcode128.php';

if (isset($_POST['btnsave'])) {

  $barcode = $_POST['txtbarcode'];
  $product = $_POST['txtselectproduct'];
  $to = $_POST['txtselectdeptto'];
  $from = $_POST['txtselectdeptfrom'];
  $requestedby = $_POST['txtrequestedby'];
  $requestdate = $_POST['txtrequestdate'];
  $reason = $_POST['txtreason'];
  $qty = $_POST['txtqty'];
  $status = $_POST['txtstatus'];
  


     

          $insert = $pdo->prepare("insert into  tbl_transfer (product, to_dept, from_dept, quantity, requested_by, request_date, status, reason) 
          VALUES (:product, :to, :from, :qty, :rqtby, :rqtdate, :status, :reason)");


          // $insert->bindParam(':barcode', $barcode);
          $insert->bindParam(':product', $product);
          $insert->bindParam(':to', $to);
          $insert->bindParam(':from', $from);
          $insert->bindParam(':qty', $qty);
          $insert->bindParam(':rqtby', $requestedby);
          $insert->bindParam(':rqtdate', $requestdate);
          $insert->bindParam(':status', $status);
          $insert->bindParam(':reason', $reason);

          if ($insert->execute()){

            $_SESSION['status'] = "Product Inserted Successful";
            $_SESSION['status_code'] = "success";
          } else {
            $_SESSION['status'] = "Product Inserted Failed";
            $_SESSION['status_code'] = "error";
          }

    }
?>


  <!--   ************************  Products Page ********************** -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Transfer Product</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Generate Request</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->


    
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
        <div class="card-secondary card-outline">
          
            <form action="" method="post" enctype="multipart/form-data">
              <div class="card-body">

                <div class="row">

                  <div class="col-md-6">

                    <!-- <div class="form-group">
                      <label>Barcode</label>
                      <input type="text" class="form-control" placeholder="Enter Barcode" name="txtbarcode">
                    </div> -->

                    <div class="form-group">
                      <label>Transfer Product</label>
                      <select class="form-control" Name="txtselectproduct" required>
                        <option value="" disabled selected class="">Select Product</option>

                        <?php
                        $select = $pdo->prepare("select * from tbl_product order by pid desc");
                        $select->execute();

                        while ($row = $select->fetch(PDO::FETCH_ASSOC))
                        {
                          extract($row);
                        ?>
                          <option><?php echo $row['product']; ?></option>

                        <?php
                        }

                        ?>
                      </select>
                    </div>


                    <div class="form-group">
                      <label>From Department</label>
                      <select class="form-control" Name="txtselectdeptfrom" required>
                        <option value="" disabled selected class="">Select Department</option>

                        <?php
                        $select = $pdo->prepare("select * from tbl_dept order by dept_id desc");
                        $select->execute();

                        while ($row = $select->fetch(PDO::FETCH_ASSOC))
                        {
                          extract($row);
                        ?>
                          <option><?php echo $row['dept_name']; ?></option>

                        <?php
                        }

                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>To Department</label>
                      <select class="form-control" Name="txtselectdeptto" required>
                        <option value="" disabled selected class="">Select Department</option>

                        <?php
                        $select = $pdo->prepare("select * from tbl_dept order by dept_id desc");
                        $select->execute();

                        while ($row = $select->fetch(PDO::FETCH_ASSOC))
                        {
                          extract($row);
                        ?>
                          <option><?php echo $row['dept_name']; ?></option>

                        <?php
                        }

                        ?>
                      </select>
                    </div>

                        <?php
                        echo'
                    <div class="form-group">
                        <label for="exampleInputEmail1">Requested By</label>
                        <input type="text" class="form-control" readonly placeholder="Enter Request Date" value="' . $_SESSION['username'] . '" name="txtrequestedby">
                    </div>
                       '; ?>
                    

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Request Date</label>
                        <input type="date" id="date" class="form-control" readonly placeholder="Enter Request Date" name="txtrequestdate">
                    </div>

                    <div class="form-group">
                      <label>Quantity</label>
                      <input type="number" min="1" step="n" class="form-control" placeholder="Enter Quantity" name="txtqty" required>
                    </div>

                    <div class="form-group">
                      <label>Reason</label>
                      <textarea class="form-control" placeholder="Enter Description" name="txtreason" rows="4" required></textarea>
                    </div>

                    <!-- <div class="form-group">
                      <label>Status</label>
                      <input type="text" class="form-control" placeholder="Enter Status" name="txtstatus">
                    </div> -->





                  </div>

                </div>



              </div>

              <div class="card-footer">
                <div class="text-center">
                  <button type="submit" class="btn btn-secondary" name="btnsave">Save Product</button>
                </div>
              </div>
          </div>


        </div>


        <!-- /.col-md-6 -->
        </form>



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



        var today = new Date();
        var y = today.getFullYear();
        var m = today.getMonth()+1;
        var d =today.getDate();

        if(m<10){
            m = '0'+m;
        }

        if(d<10){
            d= '0'+d;

        }

        var formattedDate= y+'-'+m+'-'+d;


        document.getElementById('date').value = formattedDate;
    
    </script>