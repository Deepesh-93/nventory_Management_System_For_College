<?php 

session_start();
// $email = $_SESSION['member_email'];
include "../includes/dbcon.php";

//Check if the user is already logged in, if yes, redirect to dashboard
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../home.php");
    exit;
}

// if(isset($_POST['submit'])){

//   $email = $_POST['member_email'];
//   $password = $_POST['password'];

//   $sql = "SELECT count(*) as total from member where member_email = '".$email."' AND password = '".$password."'  ";
//   $result = $conn-> query($sql);
//   echo $result;

//   if($result-> num_rows >0){
//     $_SESSION['member_email'] = $email;
//     header('location: ../home.php');
//     die;
//     }
// }
// session_start(); 



// include "../includes/dbcon.php";


if (isset($_POST['email']) && isset($_POST['password'])) {
	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$email = validate($_POST['email']);
	$password = validate($_POST['password']);
	
		$sql = "SELECT * FROM member WHERE member_email='".$email."'";
        $result = mysqli_query($conn, $sql);
    //    echo $row['password'];

		if ($result) {

			$row = mysqli_fetch_array($result);

            if ($row['password'] == $password) {
				$_SESSION['member_email'] = $row['member_email'];
            	$_SESSION['key'] = 'test';
				$_SESSION['member_id'] = $row['id'];
            	header("Location: ../home.php");
		        exit();
            }else{
				header("Location: ../index.php?error=Incorrect email or password");
		        exit();
			}
		}else{
			header("Location: ../index.php?error=Incorrect email password");
	        exit();
		}
}

// Check if username and password are set in POST request
if(isset($_POST["member_email"]) && isset($_POST["password"])){
    // Validate login credentials (replace this with your actual login validation)
    $username = $_POST["member_email"];
    $password = $_POST["password"];

    // Example validation (replace with your actual validation logic)
    if($username === "member_email" && $password === "password"){
        // Simulate user data retrieval (replace this with your actual database query)
        $userData = getUserDataByUsername($username); // Function to get user data from database

        if($userData) {
            // Store user data in session
            $_SESSION["loggedin"] = true;
            $_SESSION["user_id"] = $userData["member_id"]; // Assuming your user data has an "id" field
            // $_SESSION["username"] = $userData["username"];
            $_SESSION["email"] = $userData["member_email"];
            // Other user data if needed

            // Redirect to dashboard
            header("location: ../home.php");
            exit;
        } else {
            // Display error message if user data retrieval failed
            echo "Failed to retrieve user data!";
        }
    } else {
        // Display error message for invalid credentials
        echo "Invalid username or password!";
    }
}

// Function to simulate retrieving user data from the database
function getUserDataByEmail($username) {
    // Database connection settings
    $dsn = "mysql:host=localhost;dbname=inventory";
    $username_db = "your_database_username";
    $password_db = "your_database_password";

    try {
        // Connect to the database
        $pdo = new PDO($dsn, $username_db, $password_db);
        
        // Prepare a SQL statement to select user data by email
        $stmt = $pdo->prepare("SELECT id, email, other_columns FROM members WHERE email = :email");
        
        // Bind the parameter (email) to the prepared statement
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        
        // Execute the prepared statement
        $stmt->execute();
        
        // Fetch the user data as an associative array
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Close the database connection
        $pdo = null;
        
        return $user; // Return the user data
    } catch (PDOException $e) {
        // Handle database connection errors
        echo "Error: " . $e->getMessage();
        return null; // Return null if an error occurs
    }
}


?>