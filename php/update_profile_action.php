<?php
    error_reporting(E_ALL ^ E_WARNING);
    session_start();
    include "../includes/dbcon.php";
    $member_id = $_POST['member_id'];
    // $country = $_POST['country'];
    $name = $_POST['member_fullname'];
	$about = $_POST['about'];
	$address = $_POST['member_address'];
	$phone = $_POST['member_phone'];
	$email = $_POST['member_email'];
	$instagram = $_POST['member_insta_id'];
	$linkedin = $_POST['member_linkedin_id'];
    $facebook = $_POST['member_facebook_id'];
    $twitter = $_POST['member_twitter_id'];

    $sql = "UPDATE member SET member_fullname='".$name."', about='".$about."', member_address='".$address."', member_phone='".$phone."', member_email='".$email."', member_insta_id='".$instagram."', member_linkedin_id='".$linkedin."', member_facebook_id='".$facebook."',member_twitter_id='".$twitter."' WHERE member_id='".$member_id."'";
    $result = mysqli_query($conn, $sql);

	if ($result) 
    {
        header('Location: ../users-profile.php?status=Profile Updation Successful');

        
        exit();
    } 
    else
    {
        header('Location: ../users-profile.php?status=Profile Updation Unsuccessful. Please Try Again');
        exit();
    }

    mysqli_close($conn);
	
?>