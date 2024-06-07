<?php 

include_once "includes/dbcon.php";
session_start();

if ($_SESSION['useremail'] == "") {

  header('location:../index.php');
}


include_once "includes/header.php";




?>

<style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

/* * { */
    /* margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

html,
body {
    display: grid;
    height: 100%;
    width: 100%;
    place-items: center;
    background: rgb(205, 197, 197);
} */

.wrapper {
    height: 350px;
    width: 260px;
    position: relative;
    transform-style: preserve-3d;
    perspective: 1000px;
}

.wrapper .card {
    position: absolute;
    height: 100%;
    width: 100%;
    padding: 5px;
    background: #fff;
    border-radius: 10px;
    transform: translateY(0deg);
    transform-style: preserve-3d;
    backface-visibility: hidden;
    box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.7s cubic-bezier(0.4, 0.2, 0.2, 1);
}

.wrapper:hover>.front-face {
    transform: rotateY(-180deg);
}

.front-face .title {
    font-size: 25px;
    font-weight: 300;
    text-align: center;
    margin-top: 10px;
}

.wrapper .card img {
    height: 70%;
    width: 100%;
    object-fit: cover;
    border-radius: 10px;
}

.wrapper .back-face {
    display: flex;
    align-items: center;
    flex-direction: column;
    transform: rotateY(180deg);
    background-color: rgba(0, 0, 0, 0.4);
    color: #fff;
}

.wrapper:hover>.back-face {
    transform: rotateY(0deg);
}

.wrapper .back-face img {
    margin-top: 3px;
    height: 120px;
    width: 120px;
    padding: 5px;
    border-radius: 5%;
    background: linear-gradient(375deg, #1cc7d0, #2ede98);
}

.wrapper .back-face .info {
    padding: 15px;
}

.back-face .info .title {
    font-size: 25px;
    font-weight: 300;
    text-align: center;
}

    </style>



  <!--   ************************  Products Page ********************** -->

  <main id="main" class="main">

  

    <div class="pagetitle">
      <h1>Contacts</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Contact Us</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
    
    <div class="row">
    <div class="col-lg-3">

    <div class="wrapper">
        <div class="card front-face">
            <img src="ourimages/garvita.jpg">
            <div class="title">Garvita</div>

            
        </div>
        <div class="card back-face">
            <img src="ourimages/garvita.jpg">
            <div class="info">
                <div class="title">Garvita</div>
                <div class="title">2003420100039</div>
                <hr width="65%">
                <p> </p>
                <div class="col d-flex justify-content-center gap-3" >
                    <a href="https://www.linkedin.com/in/garvita-shukla-0a1b6822b" style="color:white; font-size:xx-large;"><i class="bi bi-linkedin"></i></a>
                    <a href="https://www.instagram.com/shuklagarvitaa?igsh=YzljYTk1ODg3Zg==" style="color:white; font-size:xx-large;"><i class="bi bi-instagram"></i></a>
                    <a href="mailto:garvitashukla313@gmail.com" style="color:white; font-size:xx-large;"><i class="bi bi-envelope"></i></a>
                    
                </div>
            </div>
        </div>
    </div>

    </div>


    <div class="col-lg-3">

<div class="wrapper">
    <div class="card front-face">
        <img src="ourimages/deepesh.jpg">
        <div class="title">Deepesh Pandey</div>
        
    </div>
    <div class="card back-face">
        <img src="ourimages/deepesh.jpg">
        <div class="info">
            <div class="title">Deepesh Pandey</div>
            <div class="title">2003420100036</div>
            <hr width="65%">
            <p> </p>

            <div class="col d-flex justify-content-center gap-3" >
                <a href="https://www.linkedin.com/in/deepespandey?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" style="color:white; font-size:xx-large;"><i class="bi bi-linkedin"></i></a>
                <a href="https://www.instagram.com/d_ramanju?igsh=MmR4ZHk3aHk3a2tz" style="color:white; font-size:xx-large;"><i class="bi bi-instagram"></i></a>
                <a href="mailto:deep8115p@gmail.com" style="color:white; font-size:xx-large;"><i class="bi bi-envelope"></i></a>
                
            </div>
        </div>
    </div>
</div>

</div>



    <div class="col-lg-3">

    <div class="wrapper">
        <div class="card front-face">
            <img src= "ourimages/bhawana.jpeg"> 
            <div class="title">Bhawana Agrahari</div>
            
        </div>
        <div class="card back-face">
            <img src="ourimages/bhawana.jpeg">
            <div class="info">
                <div class="title">Bhawana Agrahari</div>
                <div class="title">2003420100034</div>
                <hr width="65%">
                <p> </p>

                <div class="col d-flex justify-content-center gap-3" >
                    <a href="https://www.linkedin.com/in/bhawana-agrahari-64a7a0236/" style="color:white; font-size:xx-large;"><i class="bi bi-linkedin"></i></a>
                    <a href="" style="color:white; font-size:xx-large;"><i class="bi bi-instagram"></i></a>
                    <a href="mailto:bhawana02hari@gmail.com" style="color:white; font-size:xx-large;"><i class="bi bi-envelope"></i></a>
                    
                </div>
            </div>
        </div>
    </div>

    </div>



    <div class="col-lg-3">

    <div class="wrapper">
        <div class="card front-face">
            <img src="ourimages/dipendra.jpg">
            <div class="title">Dipendra Singh</div>
           
        </div>
        <div class="card back-face">
            <img src="ourimages/dipendra.jpg">
            <div class="info">
                <div class="title">Dipendra Singh</div>
                <div class="title">2003420100037</div>
                <hr width="65%">
                <p> </p>

                <div class="col d-flex justify-content-center gap-3" >
                    <a href="https://www.linkedin.com/in/thakur-dipendra-034571234?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app" style="color:white; font-size:xx-large;"><i class="bi bi-linkedin"></i></a>
                    <a href="https://www.instagram.com/dipendra_singh_444_?igsh=eWxvYTNydGpnZzQ1&utm_source=qr" style="color:white; font-size:xx-large;"><i class="bi bi-instagram"></i></a>
                    <a href="mailto:dipendrasingh517@gmail.com" style="color:white; font-size:xx-large;"><i class="bi bi-envelope"></i></a>
                    
                </div>
            </div>
        </div>
    </div>

    
    
    </div>
  </div>

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