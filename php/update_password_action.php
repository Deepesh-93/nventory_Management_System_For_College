<?php
    error_reporting(E_ALL ^ E_WARNING);
    session_start();
    include "../includes/dbcon.php";
    // $member_id = $_SESSION['member_id'];
    $email = $_SESSION['member_email'];
    $currentpassword = $_POST['currentpassword'];
	$newpassword = base64_encode($_POST['newpassword']);
    $renewpassword = base64_encode($_POST['renewpassword']);

    $sql = "SELECT * FROM member WHERE member_email='".$email."'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_array($result);
        echo $currentpassword;
        if ($currentpassword == base64_decode($row['password'])) {
            
            if ($newpassword == $renewpassword) {
                $sql1 = "UPDATE member SET password='".$newpassword."' WHERE member_email='".$email."'";
                $result1 = mysqli_query($conn, $sql1);
                if ($result1) {
                    header('Location: ../users-profile.php?status=Password Updated Successfuly');
                    exit();
                
                } else {
                    header('Location: ../users-profile.php?status=Password Update Unsuccessful. Please Try Again');
                    exit();    
                }

            } else {
                header('Location: ../users-profile.php?status=New Password and Confirm New Password values do not match');
                exit();    
            }

        } else {
            header('Location: ../users-profile.php?status=Current Password entered is Incorrect');
            exit();    
        }
    
    } else {
        header('Location: ../users-profile.php?status=Mmeber Details not available');
        exit();
    }
    
	mysqli_close($conn);
	
?>