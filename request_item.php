<?php
// ob_start();
// session_start();

include 'includes/functions.php';
$inventory = new Inventory();
// $inventory->checkLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Inventory Tracking System</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!--   Favicons -->
    <link href="assets/img/ugilogo.jfif" rel="icon">
    <link href="assets/img/ugilogo.jfif" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- js -->
    <script src="assets/js/supplier.js"></script>
</head>

<body>
    <!-- Mysql connection  -->
    <?php include 'includes/dbcon.php'; ?>


    <!-- ======= Header ======= -->

    <?php include "includes/header.php"; ?>

    <!-- End Header -->

    <!-- ======= Sidebar ======= -->

    <?php include "includes/sidebar.php"; ?>

    <!--   End Sidebar -->

    <?php
    // $email = $_SESSION['member_email'];
    $sql = "SELECT * from category_table";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    // echo $num;
    
    $sql2 = "SELECT * from product_table";
    $result2 = mysqli_query($conn, $sql2);
    $num2 = mysqli_num_rows($result2);
    // echo $num2;
    

    if ($num > 0) {
        $row = mysqli_fetch_assoc($result2);
    ?>






    <!--   ************************  Request Item Page ********************** -->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Request Item</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active">Request Item</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <div class='col-xl-8'>

            <div class='card'>
                <div class='card-body pt-3'>
                    <!-- Bordered Tabs -->
                    <ul class='nav nav-tabs nav-tabs-bordered'>

                        <li class='nav-item'>
                            <button class='nav-link active' data-bs-toggle='tab' data-bs-target='#new-request'>New
                                Request</button>
                        </li>

                        <li class='nav-item'>
                            <button class='nav-link' data-bs-toggle='tab' data-bs-target='#update-request'>Update
                                Request</button>
                        </li>

                        <li class='nav-item'>
                            <button class='nav-link' data-bs-toggle='tab' data-bs-target='#delete-request'>Delete
                                Request</button>
                        </li>

                    </ul>

                    <div class='tab-content pt-2'>
                        <div class='tab-pane fade show active new-request' id='new-request'>

                            <!-- New Request -->
                            <form method="POST">

                                <div class='row mb-3'>
                                    <label for='category' class='col-md-4 col-lg-3 col-form-label'>Category</label>
                                    <div class='col-md-8 col-lg-9'>
                                        <select name="category" id="category" class='form-control' required>
                                            <option value="select">Select</option>
                                            <?php
                                            //while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <!-- <option value="" class="form-control"> -->
                                            <?php echo $inventory->categoryDropdownList(); ?>

                                            <?php
                                            //}
                                            ?>
                                            <!-- </option> -->

                                        </select>
                                    </div>
                                </div>


                                <div class='row mb-3'>
                                    <label for='product' class='col-md-4 col-lg-3 col-form-label'>Product</label>
                                    <div class='col-md-8 col-lg-9'>
                                        <select name="product" id="product" class='form-control' required>
                                            <option value="select">Select</option>

                                            <?php echo $inventory->productDropdownList(); ?>

                                        </select>
                                    </div>
                                </div>


                                <div class='row mb-3'>
                                    <label for='description' class='col-md-4 col-lg-3 col-form-label'>Description</label>
                                    <div class='col-md-8 col-lg-9'>
                                        <textarea name='description' class='form-control' id='description'
                                            style='height: 100px' required></textarea>
                                    </div>
                                </div>


                                <div class='row mb-3'>
                                    <label for='purpose' class='col-md-4 col-lg-3 col-form-label'>Purpose</label>
                                    <div class='col-md-8 col-lg-9'>
                                        <textarea name='purpose' class='form-control' id='purpose'
                                            style='height: 100px' required></textarea>
                                    </div>
                                </div>


                                <div class='row mb-3'>
                                    <label for='qty' class='col-md-4 col-lg-3 col-form-label'>Quantity</label>
                                    <div class='col-md-8 col-lg-9'>
                                        <input name='qty' type='text' required class='form-control' id='qty'
                                            value=''>
                                    </div>
                                </div>


                                <div class='text-center'>
                                    <button type='submit' class='btn btn-primary'>Place Order</button>
                                </div>

                            </form>
                        </div>
                        <!-- end new request -->

                        <div class='tab-pane fade update-request pt-3' id='update-request'>
                            <!-- Update Request -->
                        </div>
                        <!-- End update request -->

                        <div class='tab-pane fade delete-request pt-3' id='delete-request'>
                            <!-- Delete Request -->
                        </div>
                        <!-- end delete request -->


                    </div>
                </div>

            </div><!-- End Bordered Tabs -->

        </div>
        </div>

        </div>
        </div>
        </section>

    </main>

<?php } ?>

    <!-- ======= Footer ======= -->

    <?php include "includes/footer.php"; ?>

    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>


</body>

</html>