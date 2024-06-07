<?php 
session_start(); 
include "../includes/dbcon.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

    // $name = $_POST['name'];
	$email = validate($_POST['email']);
    $password = $_POST['password'];
    // $repassword = $_POST['re_password'];

	if (empty($email)) {
		header("Location: ../register.php?status=User Name is required");
	    exit();
	}else if(empty($password)){
        header("Location: ../register.php?status=Password is required");
	    exit();
	}else{
		// $sql = "SELECT * FROM admin WHERE email='".$email."'";
        // $result = mysqli_query($conn, $sql);
        //echo $row['password'];
		$sql1 = "SELECT * FROM member_login WHERE email='".$email."'";
		$result1 = mysqli_query($conn, $sql1);
		$count = mysqli_num_rows($result1);
		if ($count == 0){
			if ($result) {
				$row = mysqli_fetch_array($result);
				if ($repassword == $password) {
					$_SESSION['id'] = $row['id'];
					$sql = "INSERT INTO member_login VALUES ('".$_SESSION['member_id']."','".$email."','".$password."')";
					$result = mysqli_query($conn, $sql);
					header("Location: ../home.php");
					exit();
				}else{
					header("Location: ../register.php?status=Incorect Email or password");
					exit();
				}
			}else{
				header("Location: ../register.php?status= Member data not available. Please contact IT team");
				exit();
			}
		}
		else{
			header("Location: ../register.php?status=Account already exists");
			exit();
		}
	}
	
}else{
	header("Location: ../register.php");
	exit();
}