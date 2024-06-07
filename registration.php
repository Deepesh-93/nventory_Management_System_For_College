<?php
include_once "includes/dbcon.php";
session_start();

if($_SESSION['useremail']=="" OR $_SESSION['role']=="User"){

  header('location:../index.php');
}

if($_SESSION['role']=="Admin"){

  include_once "includes/header.php";

}else{

  include_once "includes/headeruser.php";
};


$id= $_GET['id'];

error_reporting(0);

if(isset($id)){
  $delete= $pdo->prepare("delete from tbl_user where userid=".$id);

  if($delete->execute()){
    $_SESSION['status']="Account Deleted Successfully!!!";
            $_SESSION['status_code']="success";
  }else{
    $_SESSION['status']="Error in Deleting Account!!!";
    $_SESSION['status_code']="error";
  }
}


if(isset($_POST['btnsave'])){

  $username= $_POST['txtname'];
  $useremail= $_POST['txtemail'];
  $userpassword= $_POST['txtpassword'];
  $userrole= $_POST['txtselect_option'];


  if(isset($_POST['txtemail'])){
    $select=$pdo->prepare("select useremail from tbl_user where useremail='$useremail'");
    $select->execute();

    if($select->rowCount()>0){
      $_SESSION['status']="Email Already Exists!!!";
            $_SESSION['status_code']="warning";
    }else{

      $insert=$pdo->prepare("insert into tbl_user (username, useremail, userpassword, role) values(:name, :email, :password, :role)");

  $insert->bindParam(':name',$username);
  $insert->bindParam(':email',$useremail);
  $insert->bindParam(':password',$userpassword);
  $insert->bindParam(':role',$userrole);

  if($insert->execute()){
    // echo'User Inserted Successfully!!!';
    $_SESSION['status']="User Inserted Successfully!!!";
            $_SESSION['status_code']="success";
  }else{
    // echo'Error in Inserting User!!!';
    $_SESSION['status']="Error in Inserting User!!!";
            $_SESSION['status_code']="error";
  }


    }
  }


}


?>

    <!-- Main content -->
    
<main id="main" class="main">

<div class="pagetitle">
    <h1>Registration</h1>
    <!-- <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Suppliers</li>
        </ol>
    </nav> -->
</div>
<!-- End Page Title -->



<div class='col-xl-12'>
    <!-- <div class="col-lg-12"> -->
    <div class="card card-success card-outline">
        <div class="card-header">
            <h5 class="m-0">Registration Details</h5>
        </div>
       

        <div class='tab-content pt-2'>
            <!-- Product Details -->

            <div class='tab-pane fade show active product-details' id='product-details'>
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">

                            

                                    <!-- Table with stripped rows -->
              
              <div class="card-body">

              <div class="row">
                <div class="col-md-4">

                <form action="" method="post">

                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control"  placeholder="Enter Name" name="txtname" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="txtemail" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="txtpassword" required>
                  </div>

                  <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" Name="txtselect_option" required>
                          <option value="" disabled selected class="">Select Role</option>
                          <option>Admin</option>
                          <option>User</option>

                        </select>
                      </div>




                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="btnsave">Save</button>
                </div>
             

              </div>


                <div class="col-md-8">

                  <table class="table table-striped table-hover" id="tbl_user">

                  <thead>
                    <tr>
                      <!-- <td>#</td> -->
                      <td>Name</td>
                      <td>Email</td>
                      <td>Password</td>
                      <td>Role</td>
                      <td>Delete</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                     $select = $pdo->prepare("select * from tbl_user order by userid asc");
                     $select->execute();
                     while($row=$select->fetch(PDO::FETCH_OBJ))
                     {
                      echo'
                      <tr>
                      
                      <td>'.$row->username.'</td>
                      <td>'.$row->useremail.'</td>
                      <td>'.$row->userpassword.'</td>
                      <td>'.$row->role.'</td>
                      <td>
                        <a href="registration.php?id='.$row->userid.'" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
                      </td>
                      </tr>';
                     }
                    ?>

                  </tbody>

                  </table>
                </div>

              </div>
              </div>
            </div>


      </div><!-- /.container-fluid -->
      </form>

   <!-- End Table with stripped rows -->

   

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




<script>
        $(document).ready(function() {
            $('#tbl_user').DataTable();
        });
    </script>