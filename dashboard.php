<?php
include "db.php";
echo "welcome to dashboard";
session_start();
if(isset($_SESSION['user_id'])){
    if($_SESSION['role'] == "user"){
        echo "your are user";
    }else{
        header("Location: login.php");
    }
}else{
    header("Location: admin/dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <a href="logout.php">Log out</a>
</body>
</html>