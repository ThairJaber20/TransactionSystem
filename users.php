<?php
session_start();
include "includes/db.php";

if(isset($_GET['success']) && $_GET['success'] == "added"){
    echo '
    <div class="alert alert-success alert-dismissible fade show floating-alert" role="alert">
        <i class="fas fa-circle-check"></i>
        تم إنشاء المستخدم بنجاح.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>';
}

if($_SESSION['role'] != 'مدير'){
    die("ليس لديك صلاحية للوصول إلى هذه الصفحة.");
}

$users = mysqli_query($conn, "SELECT * FROM users");


?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>

<meta charset="UTF-8">
<title>إدارة المستخدمين</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>.
    

<div class="card shadow border-0 mb-4">

    <div class="card-body d-flex justify-content-between align-items-center">

        <div>

            <h2 class="fw-bold text-success mb-1">
                <i class="fas fa-users"></i>
                إدارة المستخدمين
            </h2>

            <p class="text-muted mb-0">
                قائمة المستخدمين المسجلين في النظام
            </p>

        </div>

        <a href="register.php" class="btn btn-success btn-lg">

            <i class="fas fa-user-plus"></i>

            إضافة مستخدم

        </a>

    </div>

</div>

<div class="card shadow border-0">

<div class="card-body">

<div class="row mb-3">

<div class="col-md-5">

<input
type="text"
id="searchInput"
class="form-control"
placeholder="ابحث باسم المستخدم أو الاسم...">

</div>
<div class="row mb-4">

<div class="col-md-4">

<div class="card border-0 shadow-sm">

<div class="card-body text-center">

<i class="fas fa-users fa-2x text-success mb-2"></i>

<h3>

<?= mysqli_num_rows($users); ?>

</h3>

<p class="text-muted mb-0">

إجمالي المستخدمين

</p>

</div>

</div>

</div>

</div>
</div>

<table class="table table-hover align-middle" id="usersTable">

<thead class="table-success">

<tr>

<th width="5%">#</th>

<th>الاسم</th>

<th>اسم المستخدم</th>

<th>الصلاحية</th>

<th width="18%">الإجراءات</th>

</tr>

</thead>

<tbody>

<?php $i=1; ?>
<?php while($user = mysqli_fetch_assoc($users)){ ?>

<tr>

<td><?= $i++; ?></td>

<td>

<strong>

<?= htmlspecialchars($user['full_name']); ?>

</strong>

</td>

<td>

<?= htmlspecialchars($user['username']); ?>

</td>

<td>

<?php

if($user['role']=="مدير"){

echo '<span class="badge bg-success">
<i class="fas fa-user-shield"></i>
مدير
</span>';

}else{

echo '<span class="badge bg-primary">
<i class="fas fa-user"></i>
موظف
</span>';

}

?>

</td>

<td>

<a href="edit_user.php?id=<?= $user['id']; ?>"

class="btn btn-warning btn-sm">

<i class="fas fa-pen"></i>

</a>

<a href="delete_user.php?id=<?= $user['id']; ?>"

class="btn btn-danger btn-sm"

onclick="return confirm('هل تريد حذف هذا المستخدم؟')">

<i class="fas fa-trash"></i>

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>
</div>
</div>
<div class="text-end mt-4">

<a href="dashboard.php"

class="btn btn-secondary">

<i class="fas fa-arrow-right"></i>

الرجوع للرئيسية

</a>

</div>
</div>

</div>
<script>

document.getElementById("searchInput").addEventListener("keyup", function(){

let value=this.value.toLowerCase();

let rows=document.querySelectorAll("#usersTable tbody tr");

rows.forEach(function(row){

row.style.display=row.innerText.toLowerCase().includes(value)?"":"none";

});

});

</script>
<script>

setTimeout(function(){

    document.querySelectorAll(".floating-alert").forEach(function(alert){

        alert.style.transition="0.5s";
        alert.style.opacity="0";

        setTimeout(function(){

            alert.remove();

        },500);

    });

},10000);

</script>
</body>
</html>