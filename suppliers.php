<?php
include_once "includes/dbcon.php";
session_start();

if ($_SESSION['useremail'] == "") {

    header('location:../index.php');
}


include_once "includes/header.php";


if (isset($_POST['btnsave'])) {

    $suppliername = $_POST['txtname'];
    $supplieremail = $_POST['txtemail'];
    $supplierphone = $_POST['txtphone'];
    $supplieraddress = $_POST['txtaddress'];
    $supplierstatus = $_POST['txtstatus'];

    if (empty($suppliername)) {
        $_SESSION['status'] = "Supplier Feild is Empty!!!";
        $_SESSION['status_code'] = "warning";
    } else {
        $insert = $pdo->prepare("insert into tbl_supplier (supplier_name, supplier_email, supplier_phone, supplier_address, supplier_status) values (:name, :email, :phone, :address, :status)");

        $insert->bindParam(':name', $suppliername);
        $insert->bindParam(':email', $supplieremail);
        $insert->bindParam(':phone', $supplierphone);
        $insert->bindParam(':address', $supplieraddress);
        $insert->bindParam(':status', $supplierstatus);

        if ($insert->execute()) {
            $_SESSION['status'] = "Supplier Added Successfully!!!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Failed to Add Supplier!!!";
            $_SESSION['status_code'] = "warning";
        }
    }
}

if (isset($_POST['btnupdate'])) {

    $suppliername = $_POST['txtname'];
    $supplieremail = $_POST['txtemail'];
    $supplierphone = $_POST['txtphone'];
    $supplieraddress = $_POST['txtaddress'];
    $supplierstatus = $_POST['txtstatus'];
    $id = $_POST['txtsupplierid'];

    if (empty($suppliername)) {
        $_SESSION['status'] = "Supplier Feild is Empty!!!";
        $_SESSION['status_code'] = "warning";
    } else {
        $update = $pdo->prepare("update tbl_supplier set supplier_name=:name, supplier_email=:email, supplier_phone=:phone, supplier_address=:address, supplier_status=:status where supplier_id=" . $id);

        $update->bindParam(':name', $suppliername);
        $update->bindParam(':email', $supplieremail);
        $update->bindParam(':phone', $supplierphone);
        $update->bindParam(':address', $supplieraddress);
        $update->bindParam(':status', $supplierstatus);

        if ($update->execute()) {
            $_SESSION['status'] = "Supplier Updated Successfully!!!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Failed to Update Supplier!!!";
            $_SESSION['status_code'] = "warning";
        }
    }
}

if (isset($_POST['btndelete'])) {
    $delete = $pdo->prepare("delete from tbl_supplier where supplier_id=" . $_POST['btndelete']);

    if ($delete->execute()) {
        $_SESSION['status'] = "Supplier deleted Successfully!!!";
        $_SESSION['status_code'] = "success";
    } else {

        $_SESSION['status'] = "Failed to Delete Supplier!!!";
        $_SESSION['status_code'] = "warning";
    }
}


?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Suppliers</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Suppliers</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->



    <div class='col-xl-12'>
        <!-- <div class="col-lg-12"> -->
        <div class="card card-success card-outline">
            <div class="card-header">
                <h5 class="m-0">Suppliers Details</h5>
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


                                        

                                        <form action="" method="post">

                                        <!-- <div class="col-md-3"> -->

                                            <div class="row">

                                                <?php

                                                if (isset($_POST['btnedit'])) {

                                                    $select = $pdo->prepare("select * from tbl_supplier where supplier_id=" . $_POST["btnedit"]);
                                                    $select->execute();

                                                    if ($select) {
                                                        $row = $select->fetch(PDO::FETCH_OBJ);

                                                        echo '
  <div class="col-md-4">



<div class="form-group">
    <label for="exampleInputEmail1">Supplier Name</label>
    <input type="hidden" class="form-control"  placeholder="Enter Supplier Id" value="' . $row->supplier_id . '" name="txtsupplierid">
    <input type="text" class="form-control"  placeholder="Enter Supplier Name" value="' . $row->supplier_name . '" name="txtname">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="text" class="form-control"  placeholder="Enter Supplier Email" value="' . $row->supplier_email . '" name="txtemail">
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Phone</label>
    <input type="text" class="form-control"  placeholder="Enter Supplier Phone" value="' . $row->supplier_phone . '" name="txtphone">
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input type="text" class="form-control"  placeholder="Enter Supplier Address" value="' . $row->supplier_address . '" name="txtaddress">
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Status</label>
    <input type="text" class="form-control"  placeholder="Enter Supplier Status" value="' . $row->supplier_status . '" name="txtstatus">
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
    <label for="exampleInputEmail1">Supplier Name</label>
    <input type="text" class="form-control"  placeholder="Enter Supplier Name" name="txtname">
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="text" class="form-control"  placeholder="Enter Supplier Email" name="txtemail">
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Phone</label>
    <input type="text" class="form-control"  placeholder="Enter Supplier Phone" name="txtphone">
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input type="text" class="form-control"  placeholder="Enter Supplier Address" name="txtaddress">
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Status</label>
    <input type="text" class="form-control"  placeholder="Enter Supplier Status" name="txtstatus">
</div>

<div class="card-footer">
  <button type="submit" class="btn btn-success" name="btnsave">Save</button>
</div>


</div>
  ';
                                                }
                                                ?>


                                            <!-- </div> -->

                                                <div class="col-md-8">

                                                    <table id="tbl_supplier" class="table table-striped table-hover">

                                                        <thead>
                                                            <tr>
                                                                
                                                                <td>Supplier Name</td>
                                                                <td>Email</td>
                                                                <td>Phone</td>
                                                                <td>Address</td>
                                                                <td>Status</td>
                                                                <td>Edit/Delete</td>
                                                                

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $select = $pdo->prepare("select * from tbl_supplier order by supplier_id asc");
                                                            $select->execute();
                                                            while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                                                echo '
      <tr>
      
      <td>' . $row->supplier_name . '</td>
      <td>' . $row->supplier_email . '</td>
      <td>' . $row->supplier_phone . '</td>
      <td>' . $row->supplier_address . '</td>
      <td>' . $row->supplier_status . '</td>
      <td>
        <button type="submit" class="btn btn-sm btn-primary fa fa-edit" style="color:#fffff" value="' . $row->supplier_id . '" name="btnedit"></button> <button type="submit" class="btn btn-sm btn-danger" value="' . $row->supplier_id . '" name="btndelete"><span class="fa fa-trash" style="color:#ffffff"></span></button>
      </td>
      
      </tr>';
                                                            }
                                                            ?>

                                                        </tbody>

                                                        <tfoot>
                                                            <tr>
                                                                
                                                                <td>Supplier Name</td>
                                                                <td>Email</td>
                                                                <td>Phone</td>
                                                                <td>Address</td>
                                                                <td>Status</td>
                                                                <td>Edit/Delete</td>
                                                                

                                                            </tr>
                                                        </tfoot>
                                                    </table>
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
        $(document).ready(function() {
            $('#tbl_supplier').DataTable();
        });
    </script>