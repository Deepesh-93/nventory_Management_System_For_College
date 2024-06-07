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
  $product = $_POST['txtproductname'];
  $category = $_POST['txtselect_option'];
  $description = $_POST['txtdescription'];
  $stock = $_POST['txtstock'];
  $purchaseprice = $_POST['txtpurchaseprice'];
  $saleprice = $_POST['txtsaleprice'];

  $f_name = $_FILES['myfile']['name'];
  $f_tmp = $_FILES['myfile']['tmp_name'];


  $f_size =  $_FILES['myfile']['size'];

  $f_extension = explode('.', $f_name);
  $f_extension = strtolower(end($f_extension));

  $f_newfile =  uniqid() . '.' . $f_extension;

  $store = "productimages/" . $f_newfile;


  if ($f_extension == 'jpg' || $f_extension == 'jpeg' || $f_extension == 'png' || $f_extension == 'gif') {

    if ($f_size >= 1000000) {




      $_SESSION['status'] = "Max file should be 1MB";
      $_SESSION['status_code'] = "warning";
    } else {

      if (move_uploaded_file($f_tmp, $store)) {

        $productimage = $f_newfile;


        if (empty($barcode)) {

          $insert = $pdo->prepare("insert into  tbl_product (product, category, description, stock, purchaseprice, saleprice, image) VALUES (:product, :category, :description, :stock, :pprice, :saleprice, :img)");


          // $insert->bindParam(':barcode', $barcode);
          $insert->bindParam(':product', $product);
          $insert->bindParam(':category', $category);
          $insert->bindParam(':description', $description);
          $insert->bindParam(':stock', $stock);
          $insert->bindParam(':pprice', $purchaseprice);
          $insert->bindParam(':saleprice', $saleprice);
          $insert->bindParam(':img', $productimage);

          $insert->execute();

          $pid=$pdo->lastInsertId();

          date_default_timezone_set("Asia/Calcutta");
          $newbarcode=$pid.date('his');

          $update=$pdo->prepare("UPDATE tbl_product set barcode='$newbarcode' where pid='".$pid."'");

          if($update->execute()){
            $_SESSION['status'] = "Product Inserted Successful";
            $_SESSION['status_code'] = "success";
          } else {
            $_SESSION['status'] = "Product Inserted Failed";
            $_SESSION['status_code'] = "error";
          }



        } else {


          $insert = $pdo->prepare("insert into  tbl_product (barcode, product, category, description, stock, purchaseprice, saleprice, image) VALUES (:barcode, :product, :category, :description, :stock, :pprice, :saleprice, :img)");

          $insert->bindParam(':barcode', $barcode);
          $insert->bindParam(':product', $product);
          $insert->bindParam(':category', $category);
          $insert->bindParam(':description', $description);
          $insert->bindParam(':stock', $stock);
          $insert->bindParam(':pprice', $purchaseprice);
          $insert->bindParam(':saleprice', $saleprice);
          $insert->bindParam(':img', $productimage);

          if ($insert->execute()){

            $_SESSION['status'] = "Product Inserted Successful";
            $_SESSION['status_code'] = "success";
          } else {
            $_SESSION['status'] = "Product Inserted Failed";
            $_SESSION['status_code'] = "error";
          }
        }
            }
            }
  } else {

    echo 'only jpg png and gif can be upload';

    $_SESSION['status'] = "only jpg,jpeg, png and gif can be uploaded";
    $_SESSION['status_code'] = "warning";
  }
}



?>


  <!--   ************************  Products Page ********************** -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Products</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Add Product</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->


    
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
        <div class="card-primary card-outline">
          
            <form action="" method="post" enctype="multipart/form-data">
              <div class="card-body">

                <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">
                      <label>Barcode</label>
                      <input type="text" class="form-control" placeholder="Enter Barcode" name="txtbarcode">
                    </div>

                    <div class="form-group">
                      <label>Product Name</label>
                      <input type="text" class="form-control" placeholder="Enter Name" name="txtproductname" required>
                    </div>

                    <div class="form-group">
                      <label>Category</label>
                      <select class="form-control" Name="txtselect_option" required>
                        <option value="" disabled selected class="">Select Category</option>

                        <?php
                        $select = $pdo->prepare("select * from tbl_category order by catid desc");
                        $select->execute();

                        while ($row = $select->fetch(PDO::FETCH_ASSOC))
                        {
                          extract($row);
                        ?>
                          <option><?php echo $row['category']; ?></option>

                        <?php
                        }

                        ?>
                      </select>
                    </div>


                    <div class="form-group">
                      <label>Supplier</label>
                      <select class="form-control" Name="txtselect_option" required>
                        <option value="" disabled selected class="">Select Supplier</option>

                        <?php
                        $select = $pdo->prepare("select * from tbl_supplier order by supplier_id desc");
                        $select->execute();

                        while ($row = $select->fetch(PDO::FETCH_ASSOC))
                        {
                          extract($row);
                        ?>
                          <option><?php echo $row['supplier_name']; ?></option>

                        <?php
                        }

                        ?>
                      </select>
                    </div>



                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control" placeholder="Enter Description" name="txtdescription" rows="4" required></textarea>
                    </div>



                  </div>



                  <div class="col-md-6">

                    <div class="form-group">
                      <label>Stock Quantity</label>
                      <input type="number" min="1" step="n" class="form-control" placeholder="Enter stock" name="txtstock" required>
                    </div>

                    <div class="form-group">
                      <label>Purchase Price</label>
                      <input type="number" min="1" step="n" class="form-control" placeholder="Enter stock" name="txtpurchaseprice" required>
                    </div>

                    <div class="form-group">
                      <label>Sale price</label>
                      <input type="alphanumeric" min="0" step="n" class="form-control" placeholder="Enter stock" name="txtsaleprice" >
                    </div>

                    <div class="form-group">
                      <label>Product image</label>
                      <input type="file" class="input-group" name="myfile" required>
                      <p>Uplode Image</p>
                    </div>





                  </div>

                </div>



              </div>

              <div class="card-footer">
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="btnsave">Save Product</button>
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
    </script>