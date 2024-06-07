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


if (isset($_POST['btnsave'])) {

    $product = $_POST['txtproduct'];
    $requestqty = $_POST['txtrequestqty'];
    $requestdate = $_POST['txtrequestdate'];
    $purpose = $_POST['txtpurpose'];
    $status = $_POST['txtstatus'];

    if (empty($product)) {
        $_SESSION['status'] = "Request Feild is Empty!!!";
        $_SESSION['status_code'] = "warning";
    } else {
        $insert = $pdo->prepare("insert into tbl_request (product, request_qty, request_date, purpose, status) values (:product, :requestqty, :requestdate, :purpose, :status)");

        $insert->bindParam(':product', $product);
        $insert->bindParam(':requestqty', $requestqty);
        $insert->bindParam(':requestdate', $requestdate);
        $insert->bindParam(':purpose', $purpose);
        $insert->bindParam(':status', $status);

        if ($insert->execute()) {
            $_SESSION['status'] = "Request Added Successfully!!!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Failed to Add Request!!!";
            $_SESSION['status_code'] = "warning";
        }
    }
}

if (isset($_POST['btnupdate'])) {

    $product = $_POST['txtproduct'];
    $requestqty = $_POST['txtrequestqty'];
    $requestdate = $_POST['txtrequestdate'];
    $purpose = $_POST['txtpurpose'];
    $status = $_POST['txtstatus'];
    $id = $_POST['txtrequestid'];

    if (empty($product)) {
        $_SESSION['status'] = "Request Feild is Empty!!!";
        $_SESSION['status_code'] = "warning";
    } else {
        $update = $pdo->prepare("update tbl_request set product=:product, request_qty=:requestqty,request_date=:requestdate, purpose=:purpose, status=:status where request_id=" . $id);

        $update->bindParam(':product', $product);
        $update->bindParam(':requestqty', $requestqty);
        $update->bindParam(':requestdate', $requestdate);
        $update->bindParam(':purpose', $purpose);
        $update->bindParam(':status', $status);

        if ($update->execute()) {
            $_SESSION['status'] = "Request Updated Successfully!!!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Failed to Update Request!!!";
            $_SESSION['status_code'] = "warning";
        }
    }
}

if (isset($_POST['btndelete'])) {
    $delete = $pdo->prepare("delete from tbl_request where request_id=" . $_POST['btndelete']);

    if ($delete->execute()) {
        $_SESSION['status'] = "Request deleted Successfully!!!";
        $_SESSION['status_code'] = "success";
    } else {

        $_SESSION['status'] = "Failed to Delete Request!!!";
        $_SESSION['status_code'] = "warning";
    }
}




?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Requested Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Requested Product</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->



    <div class='col-xl-12'>
        <!-- <div class="col-lg-12"> -->
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h5 class="m-0">Product Details</h5>
            </div>
            

            <div class='tab-content pt-2'>
                <!-- Product Details -->

                <div class='tab-pane fade show active product-details' id='product-details'>
                    <section class="section">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-body">

                                        <!-- Table with stripped rows -->



                                        <!-- <form action="" method="post"> -->

                                            <div class="row">




                                                <div class="col-md-12">

                                                    <table id="tbl_request" class="table table-striped table-hover">

                                                        <thead>
                                                            <tr>
                                                                <!-- <td>#</td> -->
                                                                <td>Product Name</td>
                                                                <td>Request QTY</td>
                                                                <td>Request Date</td>
                                                                <td>Requested By</td>
                                                                <td>Purpose</td>
                                                                <td>Status</td>
                                                                <!-- <td>Edit/Delete</td> -->
                                                                

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $select = $pdo->prepare("select * from tbl_request order by request_id asc");
                                                            $select->execute();
                                                            while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                                                echo '
      <tr>
      <td>' . $row->product . '</td>
      <td>' . $row->request_qty . '</td>
      <td>' . $row->request_date . '</td>
      <td>' . $row->requested_by . '</td>
      <td>' . $row->purpose . '</td>
      <td>' . $row->status . '</td>
      
    
      </tr>';
                                                            }
                                                            ?>

                                                        </tbody>

                                                        <!-- <tfoot>
                                                            <tr>
                                                                <td>#</td>
                                                                <td>Product Name</td>
                                                                <td>Request QTY</td>
                                                                <td>Request Date</td>
                                                                <td>Purpose</td>
                                                                <td>Edit</td>
                                                                <td>Delete</td>
                                                            </tr>
                                                        </tfoot> -->
                                                    </table>
                                                </div>

                                            </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.col-md-6 -->


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
        $(document).ready(function() {
            $('#tbl_request').DataTable();
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

<script>
    // remove row without deleting data from database


    
    // document.addEventListener('DOMContentLoaded', function () {
        
    //     var buttons = document.querySelectorAll('.remove-row');

        
    //     buttons.forEach(function (button) {
    //         button.addEventListener('click', function () {
                
    //             var row = this.closest('tr');
                
              
    //             if (row) {
    //                 row.remove();
    //             }
    //         });
    //     });
    // });
</script>
