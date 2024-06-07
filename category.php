<?php
include_once "includes/dbcon.php";
session_start();

if ($_SESSION['useremail'] == "") {

    header('location:../index.php');
}



include_once "includes/header.php";


if (isset($_POST['btnsave'])) {

    $category = $_POST['txtcategory'];

    if (empty($category)) {
        $_SESSION['status'] = "Category Feild is Empty!!!";
        $_SESSION['status_code'] = "warning";
    } else {
        $insert = $pdo->prepare("insert into tbl_category (category) values (:cat)");

        $insert->bindParam(':cat', $category);

        if ($insert->execute()) {
            $_SESSION['status'] = "Category Added Successfully!!!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Failed to Add Category!!!";
            $_SESSION['status_code'] = "warning";
        }
    }
}

if (isset($_POST['btnupdate'])) {

    $category = $_POST['txtcategory'];
    $id = $_POST['txtcatid'];

    if (empty($category)) {
        $_SESSION['status'] = "Category Feild is Empty!!!";
        $_SESSION['status_code'] = "warning";
    } else {
        $update = $pdo->prepare("update tbl_category set category=:cat where catid=" . $id);

        $update->bindParam(':cat', $category);

        if ($update->execute()) {
            $_SESSION['status'] = "Category Updated Successfully!!!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Failed to Update Category!!!";
            $_SESSION['status_code'] = "warning";
        }
    }
}

if (isset($_POST['btndelete'])) {
    $delete = $pdo->prepare("delete from tbl_category where catid=" . $_POST['btndelete']);

    if ($delete->execute()) {
        $_SESSION['status'] = "Category deleted Successfully!!!";
        $_SESSION['status_code'] = "success";
    } else {

        $_SESSION['status'] = "Failed to Delete Category!!!";
        $_SESSION['status_code'] = "warning";
    }
}


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



    <div class='col-xl-12'>
        <!-- <div class="col-lg-12"> -->
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h5 class="m-0">Category Form</h5>
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

                                                    $select = $pdo->prepare("select * from tbl_category where catid=" . $_POST["btnedit"]);
                                                    $select->execute();

                                                    if ($select) {
                                                        $row = $select->fetch(PDO::FETCH_OBJ);

                                                        echo '
  <div class="col-md-4">



<div class="form-group">
    <label for="exampleInputEmail1">Category</label>
    <input type="hidden" class="form-control"  placeholder="Enter Category" value="' . $row->catid . '" name="txtcatid">
    <input type="text" class="form-control"  placeholder="Enter Category" value="' . $row->category . '" name="txtcategory">
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
    <label for="exampleInputEmail1">Category</label>
    <input type="text" class="form-control"  placeholder="Enter Category" name="txtcategory">
  </div>

<div class="card-footer">
  <button type="submit" class="btn btn-warning" name="btnsave">Save</button>
</div>


</div>
  ';
                                                }
                                                ?>



                                                <div class="col-md-8">

                                                    <table id="tbl_category" class="table table-striped table-hover">

                                                        <thead>
                                                            <tr>
                                                                <!-- <td>#</td> -->
                                                                <td>Category</td>
                                                                <td>Edit</td>
                                                                <td>Delete</td>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $select = $pdo->prepare("select * from tbl_category order by catid asc");
                                                            $select->execute();
                                                            while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                                                echo '
      <tr>
      
      <td>' . $row->category . '</td>
      <td>
        <button type="submit" class="btn btn-primary" value="' . $row->catid . '" name="btnedit">Edit</button>
      </td>
      <td>
          <button type="submit" class="btn btn-info" value="' . $row->catid . '" name="btndelete">Delete</button>
      </td>
      </tr>';
                                                            }
                                                            ?>

                                                        </tbody>

                                                        <tfoot>
                                                            <tr>
                                                                <!-- <td>#</td> -->
                                                                <td>Category</td>
                                                                <td>Edit</td>
                                                                <td>Delete</td>

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
            $('#tbl_category').DataTable();
        });
    </script>