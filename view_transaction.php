<?php
include "includes/db.php";

if(!isset($_GET['id'])){
    header("Location: transactions.php");
    exit;
}


$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM transactions WHERE id='$id'");

$row = mysqli_fetch_assoc($result);
?>
<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<title>تفاصيل المعاملة</title>

<link rel="stylesheet" href="assets/css/style.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<body>
<div class="sidebar">

<div class="logo">

<img src="assets/images/logo.jpg" alt="شعار الوزارة">

</div>

 <ul>

       <li>
         <a href="dashboard.php">
         <i class="fas fa-home"></i>
          الرئيسية
         </a>
       </li>

       <li>
         <a href="transactions.php">
         <i class="fas fa-folder"></i>
          المعاملات
         </a>
        </li>

        <li class="active">
          <a href="archive.php">
          <i class="fas fa-box-archive"></i>
          الأرشيف
         </a>
       </li>

        <li>
          <a href="reports.php">
         <i class="fas fa-chart-column"></i>
          التقارير
         </a>
         </li>

   </ul>

</div>

<div class="main-content">

<div class="topbar">

 <h2>تفاصيل المعاملة</h2>


     
 </div> 
<div class="container mt-5">
<tr>
 <h2 class="page-title">
    تفاصيل المعاملة
 </h2>
 <table class="table table-bordered">

<tr>
<th>رقم المعاملة</th>
<td><?= $row['transaction_number']; ?></td>
</tr>

<tr>
<th>الموضوع</th>
<td><?= $row['subject']; ?></td>
</tr>

<tr>
<th>صادرة - واردة</th>
<td><?= $row['transaction_type']; ?></td>
</tr>

<tr>
<th>الجهة</th>
<td><?= $row['sender']; ?></td>
</tr>

<tr>
<th>الحالة</th>
<td><?= $row['status']; ?></td>
</tr>

<tr>
<th>التاريخ</th>
<td><?= $row['transaction_date']; ?></td>
</tr>

</table>

<hr>

<h3>📎 المرفقات</h3>

 

<br>

<?php
$files = mysqli_query($conn, "SELECT * FROM attachments WHERE transaction_id='$id'");
?>

<table class="table table-bordered">

<tr>
    <th>اسم الملف</th>
    <th>تحميل</th>
</tr>

<?php while($file = mysqli_fetch_assoc($files)){ ?>

<tr>

    <td><?= $file['file_name']; ?></td>

    <td>
        <a href="<?= $file['file_path']; ?>" class="btn btn-primary btn-sm" download>
            تحميل
        </a>
        <a href="delete_attachment.php?id=<?= $file['id']; ?>"
       class="btn btn-danger btn-sm"
       onclick="return confirm('هل تريد حذف هذا المرفق؟')">

        <i class="fas fa-trash"></i>
        حذف

    </a>
    </td>

</tr>

<?php } ?>

</table>
<form action="upload_attachment.php" method="POST" enctype="multipart/form-data" class="mb-4">

        <input type="hidden" name="transaction_id" value="<?= $row['id']; ?>">

        <div class="row">

            <div class="col-md-8">
                <input type="file" name="attachment" class="form-control" required>
            </div>

            <div class="col-md-4">
                <button type="submit" class="btn btn-success w-100">
                    <i class="fas fa-upload"></i>
                    رفع المرفق
                </button>
            </div>

        </div>

    </form>

<a href="transactions.php" class="btn btn-success">
    الرجوع إلى المعاملات
</a>


   

<?php

$files = mysqli_query($conn,"SELECT * FROM attachments WHERE transaction_id='$id'");

?>


</div>


</body>

</html>