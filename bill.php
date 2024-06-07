<?php
include_once "includes/dbcon.php";
session_start();

if ($_SESSION['useremail'] == "") {

    header('location:../index.php');
}



include_once "includes/header.php";

if (isset($_POST['btnsave'])) {
    
  $f_name = $_FILES['txtbillimg']['name'];
  $f_tmp = $_FILES['txtbillimg']['tmp_name'];
 
  $date = $_POST['txtbilldate'];

  $f_size =  $_FILES['txtbillimg']['size'];

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

          $insert = $pdo->prepare("insert into  tbl_bill (bill_img, bill_date) VALUES (:img, :date)");

          $insert->bindParam(':img', $productimage);
          $insert->bindParam(':date', $date);

          if ($insert->execute()) {
            $_SESSION['status'] = "Bill Added Successfully!!!";
            $_SESSION['status_code'] = "success";
          } else {
            $_SESSION['status'] = "Failed to Add Bill!!!";
            $_SESSION['status_code'] = "warning";
          }
        }
    }
}
  }
    
}


if (isset($_POST['btnupdate'])) {

    $Bill = $_POST['txtBill'];
    $id = $_POST['txtcatid'];

    if (empty($Bill)) {
        $_SESSION['status'] = "Bill Feild is Empty!!!";
        $_SESSION['status_code'] = "warning";
    } else {
        $update = $pdo->prepare("update tbl_Bill set Bill=:cat where catid=" . $id);

        $update->bindParam(':cat', $Bill);

        if ($update->execute()) {
            $_SESSION['status'] = "Bill Updated Successfully!!!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Failed to Update Bill!!!";
            $_SESSION['status_code'] = "warning";
        }
    }
}

if (isset($_POST['btndelete'])) {
    $delete = $pdo->prepare("delete from tbl_bill where bill_id=" . $_POST['btndelete']);

    if ($delete->execute()) {
        $_SESSION['status'] = "Bill deleted Successfully!!!";
        $_SESSION['status_code'] = "success";
    } else {

        $_SESSION['status'] = "Failed to Delete Bill!!!";
        $_SESSION['status_code'] = "warning";
    }
}


?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Bill</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Bill</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->



    <div class='col-xl-12'>
        <!-- <div class="col-lg-12"> -->
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h5 class="m-0">Bill Details</h5>
            </div>
            <!-- <div class='card'> -->
            <!-- <div class='card-body pt-3'> -->
            <!-- Bordered Tabs -->
            <!-- <ul class='nav nav-tabs nav-tabs-bordered'>

        <li class='nav-item'>
          <button class='nav-link active' data-bs-toggle='tab' data-bs-target='#product-details'>Product Details</button>
        </li>

      </ul> -->

            <div class='tab-content pt-2'>
                <!-- Product Details -->

                <div class='tab-pane fade show active product-details' id='product-details'>
                    <section class="section">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-body">

                                        <!-- Table with stripped rows -->



                                        <form action="" method="post" enctype="multipart/form-data">

                                            <div class="row">

                                                <?php

                                                if (isset($_POST['btnedit'])) {

                                                    $select = $pdo->prepare("select * from tbl_bill where bill_id=" . $_POST["btnedit"]);
                                                    $select->execute();

                                                    if ($select) {
                                                        $row = $select->fetch(PDO::FETCH_OBJ);

                                                        echo '
  <div class="col-md-4">



<div class="form-group">
    <label for="exampleInputEmail1">Bill</label>
    <input type="hidden" class="form-control"  placeholder="Enter Bill" value="' . $row->bill_id . '" name="txtbillid">
    <input type="file" class="form-control"  placeholder="Enter Bill" value="' . $row->bill_img . '" name="txtbillimg">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Date</label>
    <input type="date" id="date" class="form-control"  placeholder="Enter Date" value="' . $row->bill_date . '" name="txtbilldate">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Date</label>
    <input type="date" id="date" class="form-control"  placeholder="Enter Date" value="' . $row->supplier_name . '" name="txtbilldate">
  </div>

<div class="card-footer">
  <button type="submit" class="btn btn-info" name="btnupdate">Update</button>
</div>
</form>

</div>
  ';
                                                    }
                                                } else {
                                                    echo '
  <div class="col-md-4">



<div class="form-group">
    <label for="exampleInputEmail1">Bill Image</label>
    <input type="file" class="form-control"  placeholder="Enter Bill" name="txtbillimg">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Date</label>
    <input type="date" id="date" class="form-control"  placeholder="Enter Date" name="txtbilldate">
  </div>

  
<div class="card-footer">
  <button type="submit" class="btn btn-warning" name="btnsave">Save</button>
</div>


</div>
  ';
                                                }
                                                ?>



                                                <div class="col-md-8">


                                                

<div class="container">
<div class="row">
<?php 
$count = 0; // Initialize count for images in current row
$select = $pdo->prepare("SELECT * FROM tbl_bill ORDER BY bill_id ASC");
$select->execute();
while ($row = $select->fetch(PDO::FETCH_OBJ)) {
    echo '<div class="col-lg-4 col-md-12 mb-4 mb-lg-0">';
    echo '<div class="polaroid__content-image">';
    // Check if bill_img is not empty
    if (!empty($row->bill_img)) {
        echo '<img src="productimages/'. $row->bill_img. '" class="img-fluid" style="height:300px; width:300px;" alt="Responsive image">';
    } else {
        echo '<img src="productimages/noimage.jpg" class="img-fluid" style="height:300px; width:300px;" alt="Responsive image">';
    }
    echo '</div>';
    echo '<div class="row mt-3 pt-3">';
    echo '<div class="col-md-6">';
    echo '<p>'.$row->bill_date.'</p>';
    echo '</div>';
    echo '<div class="col-md-3 align-items-center">';
    echo '<button type="submit" class="btn btn-sm btn-danger" value="' . $row->bill_id . '" name="btndelete"><span class="fa fa-trash" style="color:#ffffff"></span></button>';
    echo '</div>';
    echo '<div class="col-md-3 align-items-center">';
    echo '<button type="submit" class="btn btn-sm btn-info" value="' . $row->bill_id . '" name="btndownload"><span class="fa fa-download" style="color:#ffffff"></span></button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    $count++; // Increment count for images in current row
    // If three images are displayed, start a new row
    if ($count % 3 == 0) {
        echo '</div><div class="row">';
    }
}
?>
</div>
</div>


                                                
                                            </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.col-md-6 -->
                            </form>


                            <!-- End Table with stripped rows -->

                        </div>
                </div>

            </div>
        </div>
        </section>
    </div>
                                                        </div>
                                                        </div>
    </div>
</main>
    

    <?php include_once "includes/footer.php" ?>



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
    