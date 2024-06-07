<?php

include_once "includes/dbcon.php";
session_start();

if ($_SESSION['useremail'] == "") {

  header('location:../index.php');
}


include_once "includes/header.php";


  $id=$_GET['id'];

  $select=$pdo->prepare("SELECT * from tbl_product where pid=$id");
  $select->execute();

  $row=$select->fetch(PDO::FETCH_ASSOC);

  $id_db=$row['pid'];

  $barcode_db = $row['barcode'];
  $product_db = $row['product'];
  $category_db = $row['category'];
  $description_db = $row['description'];
  $stock_db = $row['stock'];
  $purchaseprice_db = $row['purchaseprice'];
  $saleprice_db = $row['saleprice'];
  $image_db = $row['image'];

  // print_r($row);

  if (isset($_POST['btneditproduct'])) {

    // $barcode_txt = $_POST['txtbarcode'];
    $product_txt = $_POST['txtproductname'];
    $category_txt = $_POST['txtselect_option'];
    $description_txt = $_POST['txtdescription'];
    $stock_txt = $_POST['txtstock'];
    $purchaseprice_txt = $_POST['txtpurchaseprice'];
    $saleprice_txt = $_POST['txtsaleprice'];

    $f_name = $_FILES['myfile']['name'];

    if(!empty($f_name)){
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

        $f_newfile;



      $update = $pdo->prepare("update tbl_product set product=:product, category=:category, description=:description, stock=:stock, purchaseprice=:pprice, saleprice=:saleprice, image=:image where pid=$id");


      // $update->bindParam(':barcode', $barcode);
      $update->bindParam(':product', $product_txt);
      $update->bindParam(':category', $category_txt);
      $update->bindParam(':description', $description_txt);
      $update->bindParam(':stock', $stock_txt);
      $update->bindParam(':pprice', $purchaseprice_txt);
      $update->bindParam(':saleprice', $saleprice_txt);
      $update->bindParam(':image', $f_newfile);

      if($update->execute()){
        $_SESSION['status'] = "Product Updated Successfully with New Image!!!";
        $_SESSION['status_code'] = "success";
      }else{
        $_SESSION['status'] = "Product Update Failed!!!";
        $_SESSION['status_code'] = "error";
      }

      }}}


    }else{

      $update = $pdo->prepare("update tbl_product set product=:product, category=:category, description=:description, stock=:stock, purchaseprice=:pprice, saleprice=:saleprice, image=:image where pid=$id");


          // $update->bindParam(':barcode', $barcode);
          $update->bindParam(':product', $product_txt);
          $update->bindParam(':category', $category_txt);
          $update->bindParam(':description', $description_txt);
          $update->bindParam(':stock', $stock_txt);
          $update->bindParam(':pprice', $purchaseprice_txt);
          $update->bindParam(':saleprice', $saleprice_txt);
          $update->bindParam(':image', $image_db);

          if($update->execute()){
            $_SESSION['status'] = "Product Updated Successfully!!!";
            $_SESSION['status_code'] = "success";
          }else{
            $_SESSION['status'] = "Product Update Failed!!!
            
            
            ";
            $_SESSION['status_code'] = "error";
          }
    }

  }

  $select=$pdo->prepare("SELECT * from tbl_product where pid=$id");
  $select->execute();

  $row=$select->fetch(PDO::FETCH_ASSOC);

  $id_db=$row['pid'];

  $barcode_db = $row['barcode'];
  $product_db = $row['product'];
  $category_db = $row['category'];
  $description_db = $row['description'];
  $stock_db = $row['stock'];
  $purchaseprice_db = $row['purchaseprice'];
  $saleprice_db = $row['saleprice'];
  $image_db = $row['image'];


?>
<main id="main" class="main">

<div class="pagetitle">
    <h1>Category</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Category</li>
        </ol>
    </nav>
</div>
<!-- End Page Title -->

          <div class="col-lg-12">
            <div class="card card-success card-outline">
              <div class="card-header">
                <h5 class="m-0">Edit Product</h5>
              </div>

              <div class="card-body">
              <form action="" method="post" name="formeditproduct" enctype="multipart/form-data">
                <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">
                      <label>Barcode</label>
                      <input type="text" class="form-control" value="<?php echo $barcode_db; ?>" placeholder="Enter Barcode" name="txtbarcode" disabled>
                    </div>

                    <div class="form-group">
                      <label>Product Name</label>
                      <input type="text" class="form-control" value="<?php echo $product_db; ?>"  placeholder="Enter Name" name="txtproductname" required>
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
                          <option <?php if($row['category']==$category_db) { ?>

                            selected="selected"

                            <?php }?>  > <?php echo $row['category']; ?></option>

                        <?php
                        }

                        ?>

                      </select>
                    </div>

                    

                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control" placeholder="Enter Description" name="txtdescription" rows="4" required><?php echo $description_db; ?></textarea>
                    </div>



                  </div>



                  <div class="col-md-6">

                    <div class="form-group">
                      <label>Quantity</label>
                      <input type="number" min="1" step="n" class="form-control" value="<?php echo $stock_db; ?>" placeholder="Enter stock" name="txtstock" required>
                    </div>

                    <!-- <div class="form-group">
                      <label>Purchase Price</label>
                      <input type="number" min="1" step="n" class="form-control" value="<?php echo $purchaseprice_db; ?>" placeholder="Enter stock" name="txtpurchaseprice" required>
                    </div> -->

                    <div class="form-group">
                      <label>Price</label>
                      <input type="number" min="1" step="n" class="form-control" value="<?php echo $saleprice_db; ?>" placeholder="Enter stock" name="txtsaleprice" required>
                    </div>

                    <div class="form-group">
                      <label>Product image</label><br>
                      <img src="productimages/<?php echo $image_db; ?>" class="img-rounded" width="50px;" height="50px"></img>
                      <input type="file" class="input-group" name="myfile">
                      <p>Uplode Image</p>
                    </div>





                  </div>

                </div>



              </div>

              <div class="card-footer">
                <div class="text-center">
                  <button type="submit" class="btn btn-success" name="btneditproduct">Update Product</button>
                </div>
              </div>
          </div>
          </form>


              </div>


                  <!-- /.col-md-6 -->
            </div>
          </div>
          <!-- /.col-md-6 -->
</main>



<?php include_once "includes/footer.php" ?>



<?php
if (isset($_SESSION['status']) && $_SESSION['status'] != "") {

?>
  <script>
    Swal.fire({
      icon: '<?php echo $_SESSION['status_code'] ?>',
      title: '<?php echo $_SESSION['status'] ?>'
    });
  </script>

<?php
  unset($_SESSION['status']);
}
?>
