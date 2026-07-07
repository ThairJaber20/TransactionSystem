<?php
session_start();
include "includes/db.php";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){

        $user = mysqli_fetch_assoc($result);

        if(password_verify($password,$user['password'])){

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];

            header("Location: dashboard.php");
            exit;

        }else{

            $error = "كلمة المرور غير صحيحة";

        }

    }else{

        $error = "اسم المستخدم غير موجود";

    }

}
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<title>تسجيل الدخول</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
    font-family:Tahoma;
}

.login-box{

    width:420px;

    margin:80px auto;

    background:#fff;

    padding:35px;

    border-radius:15px;

    box-shadow:0 5px 15px rgba(0,0,0,.1);

    text-align:center;

}

.logo{

    width:120px;

    margin-bottom:15px;

}

h2{

    color:#0d7c3f;

    margin-bottom:25px;

}

.btn-success{

    width:100%;

    background:#0d7c3f;

}

</style>

</head>

<body>

<div class="login-box">

<img src="assets/images/logo.png" class="logo">

<h2>نظام إدارة المعاملات</h2>

<?php
if(isset($error)){
    echo "<div class='alert alert-danger'>$error</div>";
}
?>

<form method="POST">

<div class="mb-3">

<input
type="text"
name="username"
class="form-control"
placeholder="اسم المستخدم"
required>

</div>

<div class="mb-3">

<input
type="password"
name="password"
class="form-control"
placeholder="كلمة المرور"
required>

</div>

<button
type="submit"
name="login"
class="btn btn-success">

تسجيل الدخول

</button>

<br><br>



</form>

</div>

</body>

</html>