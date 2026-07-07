<?php
session_start();
include "includes/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

// منع حذف المستخدم الحالي
if($id == $_SESSION['user_id']){
    echo "<script>
            alert('لا يمكنك حذف حسابك الحالي.');
            window.location='users.php';
          </script>";
    exit;
}

mysqli_query($conn,"DELETE FROM users WHERE id='$id'");

header("Location: users.php");
exit;
?>