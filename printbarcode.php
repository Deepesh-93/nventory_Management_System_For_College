<?php
include_once "includes/dbcon.php";
session_start();

if ($_SESSION['useremail'] == "") {

    header('location:../index.php');
}


include_once "includes/header.php";
?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Print Barcode</h1>
        <!-- <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Category</li>
            </ol>
        </nav> -->
    </div>
    <!-- End Page Title -->



    <div class='col-xl-12'>
        <!-- <div class="col-lg-12"> -->
        <div class="card card-primary card-outline">
            <!-- <div class="card-header">
                <h5 class="m-0">Category Form</h5>
            </div> -->
            

            <div class='tab-content pt-2'>
                <!-- Product Details -->

                <div class='tab-pane fade show active product-details' id='product-details'>
                    <section class="section">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-body">

                                        <!-- Table with stripped rows -->

                                        



<form class="form-horizontal" method="post" action="UI/barcode/barcode.php" target="_blank">


<?php

$id = $_GET['id'];
$select = $pdo->prepare("select * from tbl_product where pid = $id");

$select->execute();

while($row=$select->fetch(PDO::FETCH_OBJ)){



 echo '


 <div class="row">
 <div class="col-md-6">

     <ul class="list-group">

         <center>
             <p class="list-group-item list-group-item-info"><b>PRODUCT DETAILS</b></p>
         </center>

         <div class="form-group">
<label class="control-label col-sm-2" for="product">Product:</label>
<div class="col-sm-10">
<input autocomplete="OFF" type="text" class="form-control" value="' .$row->product.'" id="product" name="product" readonly>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-2" for="product_id">Barcode:</label>
<div class="col-sm-10">
<input autocomplete="OFF" type="text" class="form-control" value="' .$row->barcode.'" id="barcode" name="barcode" readonly>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-2" for="rate">Price</label>
<div class="col-sm-10">
<input autocomplete="OFF" type="text" class="form-control" value="' .$row->saleprice.'" id="rate"  name="rate" readonly>
</div>
</div>

<div class="form-group">
<label class="control-label col-sm-2" for="rate">Stock QTY</label>
<div class="col-sm-10">
<input autocomplete="OFF" type="text" class="form-control" value="' .$row->stock.'" id="stock"  name="stock" readonly>
</div>
</div>


<div class="form-group">

<div class="col-sm-10">
<input autocomplete="OFF" hidden type="print_qty" class="form-control" id="print_qty" value="1"  name="print_qty">
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn btn-primary">Print Barcode</button>
</div>
</div>


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


   







