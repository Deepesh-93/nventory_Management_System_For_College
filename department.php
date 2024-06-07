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

    $dept = $_POST['txtdept'];

    if (empty($dept)) {
        $_SESSION['status'] = "Department Feild is Empty!!!";
        $_SESSION['status_code'] = "warning";
    } else {
        $insert = $pdo->prepare("insert into tbl_dept (dept_name) values (:dept)");

        $insert->bindParam(':dept', $dept);

        if ($insert->execute()) {
            $_SESSION['status'] = "Department Added Successfully!!!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Failed to Add Department!!!";
            $_SESSION['status_code'] = "warning";
        }
    }
}

if (isset($_POST['btnupdate'])) {

    $dept = $_POST['txtdept'];
    $id = $_POST['txtdeptid'];

    if (empty($dept)) {
        $_SESSION['status'] = "Department Feild is Empty!!!";
        $_SESSION['status_code'] = "warning";
    } else {
        $update = $pdo->prepare("update tbl_dept set dept_name=:dept where dept_id=" . $id);

        $update->bindParam(':dept', $dept);

        if ($update->execute()) {
            $_SESSION['status'] = "Department Updated Successfully!!!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Failed to Update Department!!!";
            $_SESSION['status_code'] = "warning";
        }
    }
}

if (isset($_POST['btndelete'])) {
    $delete = $pdo->prepare("delete from tbl_dept where dept_id=" . $_POST['btndelete']);

    if ($delete->execute()) {
        $_SESSION['status'] = "Department deleted Successfully!!!";
        $_SESSION['status_code'] = "success";
    } else {

        $_SESSION['status'] = "Failed to Delete Department!!!";
        $_SESSION['status_code'] = "warning";
    }
}


?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Department</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Department</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->



    <div class='col-xl-12'>
        <!-- <div class="col-lg-12"> -->
        <div class="card card-success card-outline">
            <div class="card-header">
                <h5 class="m-0">Department Form</h5>
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



                                        <form action="" method="post">

                                            <div class="row">

                                                <?php

                                                if (isset($_POST['btnedit'])) {

                                                    $select = $pdo->prepare("select * from tbl_dept where dept_id=" . $_POST["btnedit"]);
                                                    $select->execute();

                                                    if ($select) {
                                                        $row = $select->fetch(PDO::FETCH_OBJ);

                                                        echo '
  <div class="col-md-4">



<div class="form-group">
    <label for="exampleInputEmail1">Update Department</label>
    <input type="hidden" class="form-control"  placeholder="Enter dept" value="' . $row->dept_id . '" name="txtdeptid">
    <input type="text" class="form-control"  placeholder="Enter dept" value="' . $row->dept_name . '" name="txtdept">
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
    <label for="exampleInputEmail1">Add Department</label>
    <input type="text" class="form-control"  placeholder="Enter dept" name="txtdept">
  </div>

<div class="card-footer">
  <button type="submit" class="btn btn-success" name="btnsave">Save</button>
</div>


</div>
  ';
                                                }
                                                ?>



                                                <div class="col-md-8">

                                                    <table id="tbl_dept" class="table table-striped table-hover">

                                                        <thead>
                                                            <tr>
                                                                <!-- <td>#</td> -->
                                                                <td>Department</td>
                                                                <td>Edit</td>
                                                                <td>Delete</td>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $select = $pdo->prepare("select * from tbl_dept order by dept_id asc");
                                                            $select->execute();
                                                            while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                                                echo '
      <tr>
      
      <td>' . $row->dept_name . '</td>
      <td>
        <button type="submit" class="btn btn-primary" value="' . $row->dept_id . '" name="btnedit">Edit</button>
      </td>
      <td>
          <button type="submit" class="btn btn-info" value="' . $row->dept_id . '" name="btndelete">Delete</button>
      </td>
      </tr>';
                                                            }
                                                            ?>

                                                        </tbody>

                                                        <!-- <tfoot>
                                                            <tr>
                                                                <td>#</td>
                                                                <td>dept</td>
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
            $('#tbl_dept').DataTable();
        });
    </script>