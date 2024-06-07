<?php

include_once "includes/dbcon.php";
session_start();

if($_SESSION['useremail']==""){

  header('location:../index.php');
}

if($_SESSION['role']=="Admin"){

  include_once "includes/header.php";

}else{

  include_once "includes/headeruser.php";
};



if(isset($_POST['btn_update'])){

  // get data from user

  $oldpassword_txt=$_POST['txt_old'];
  $newpassword_txt=$_POST['txt_new'];
  $confirmpassword_txt=$_POST['txt_confirm'];

  // get data from database

  $email=$_SESSION['useremail'];

  $select = $pdo->prepare("select * from tbl_user where useremail='$email'");
  $select->execute();
  $row=$select->fetch(PDO::FETCH_ASSOC);

  $useremail_db=$row['useremail'];
  $password_db=$row['userpassword'];

  // compare user value to database value and update

  if($oldpassword_txt== $password_db){

    if($newpassword_txt==$confirmpassword_txt){

      $update=$pdo->prepare("update tbl_user set userpassword=:pass where useremail=:email");

      $update->bindParam(':pass',$confirmpassword_txt);
      $update->bindParam(':email',$email);

      if($update->execute()){
            $_SESSION['status']="Password Updated Successfully!!!";
            $_SESSION['status_code']="success";
      }

    }else{

      $_SESSION['status']="New Password Not Matched!!!";
      $_SESSION['status_code']="error";

    }

  //   $_SESSION['status']="Password Matched!!!";
  // $_SESSION['status_code']="success";
  }else{

    $_SESSION['status']="Password Not Matched!!!";
  $_SESSION['status_code']="error";

  };
}



?>

<main id="main" class="main">

    
    <!-- End Page Title -->

          <div class="col-lg-12">
          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="" method="post">
                <div class="card-body">

                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Old Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword3" placeholder="Old Password" name="txt_old">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword3" placeholder="New Password" name="txt_new">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword3" placeholder="Confirm Password" name="txt_confirm">
                    </div>
                  </div>

                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="btn_update">Update Password</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

          </div>
</main>

</div>
<?php include_once "includes/footer.php" ; ?>

<?php
  if(isset($_SESSION['status']) && $_SESSION['status']!=""){

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




