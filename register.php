<?php
include "includes/db.php";

if(isset($_POST['register'])){

    $full_name = $_POST['full_name'];
    $username  = $_POST['username'];
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(full_name, username, password)
            VALUES('$full_name','$username','$password')";

    if(mysqli_query($conn, $sql)){

    header("Location: users.php?success=added");
    exit;

}else{

    echo "<script>alert('اسم المستخدم موجود مسبقًا');</script>";

}
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<title>إنشاء مستخدم جديد</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
    font-family:Tahoma;
}

.register-box{

    width:450px;

    margin:70px auto;

    background:#fff;

    padding:30px;

    border-radius:15px;

    box-shadow:0 5px 15px rgba(0,0,0,.1);

}

h2{

    text-align:center;

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

<div class="register-box">

<h2>إنشاء مستخدم جديد</h2>

<form method="POST">

<div class="mb-3">

<label>الاسم الكامل</label>

<input type="text"
class="form-control"
name="full_name"
required>

</div>

<div class="mb-3">

<label>اسم المستخدم</label>

<input type="text"
class="form-control"
name="username"
required>

</div>

<div class="mb-3">

<label>كلمة المرور</label>

<input type="password"
class="form-control"
name="password"
required>

</div>

<button type="submit"
name="register"
class="btn btn-success">

إنشاء المستخدم

</button>

</form>

</div>

</body>

</html>