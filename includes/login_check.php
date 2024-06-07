<?php
session_start();
$key = $_SESSION['key'];
if (empty($key)){
    header("Location: index.php");
}
?>