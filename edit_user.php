<?php
session_start();
include "includes/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM users WHERE id='$id'");
$user = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $full_name = $_POST['full_name'];
    $username  = $_POST['username'];
    $role      = $_POST['role'];

    if(!empty($_POST['password'])){

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        mysqli_query($conn,"
        UPDATE users
        SET full_name='$full_name',
            username='$username',
            role='$role',
            password='$password'
        WHERE id='$id'
        ");

    }else{

        mysqli_query($conn,"
        UPDATE users
        SET full_name='$full_name',
            username='$username',
            role='$role'
        WHERE id='$id'
        ");

    }

    header("Location: users.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<title>تعديل المستخدم</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-success text-white">

<h3>تعديل المستخدم</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>الاسم الكامل</label>

<input
type="text"
name="full_name"
class="form-control"
value="<?= htmlspecialchars($user['full_name']); ?>"
required>

</div>

<div class="mb-3">

<label>اسم المستخدم</label>

<input
type="text"
name="username"
class="form-control"
value="<?= htmlspecialchars($user['username']); ?>"
required>

</div>

<div class="mb-3">

<label>الصلاحية</label>

<select
name="role"
class="form-select">

<option value="مدير"
<?= $user['role']=="مدير"?"selected":""; ?>>
مدير
</option>

<option value="موظف"
<?= $user['role']=="موظف"?"selected":""; ?>>
موظف
</option>

</select>

</div>

<div class="mb-3">

<label>كلمة المرور الجديدة (اختياري)</label>

<input
type="password"
name="password"
class="form-control">

</div>

<button
type="submit"
name="update"
class="btn btn-success">

حفظ التعديلات

</button>

<a
href="users.php"
class="btn btn-secondary">

إلغاء

</a>

</form>

</div>

</div>

</div>

</body>

</html>