<?php
include "includes/db.php";

$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM transactions"));

$pending = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM transactions WHERE status='قيد التنفيذ'"));

$finished = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM transactions WHERE status='منتهية'"));

$archive = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM transactions WHERE status='مؤرشفة'"));

$latest = mysqli_query($conn, "SELECT * FROM transactions ORDER BY id DESC LIMIT 5");

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>لوحة التحكم</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<div class="sidebar">

    <div class="logo">
      <img src="assets/images/logo.jpg" alt="شعار الوزارة">
    </div>

    <ul>

       <li class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">
          <a href="dashboard.php">
         <i class="fas fa-home"></i>
         الرئيسية
         </a>
       </li>

       <li class="<?= basename($_SERVER['PHP_SELF']) == 'transactions.php' ? 'active' : '' ?>">
          <a href="transactions.php">
          <i class="fas fa-folder"></i>
         المعاملات
          </a>
        </li>

       <li class="<?= basename($_SERVER['PHP_SELF']) == 'archive.php' ? 'active' : '' ?>">
         <a href="archive.php">
         <i class="fas fa-box-archive"></i>
         الأرشيف
         </a>
       </li>

       <li class="<?= basename($_SERVER['PHP_SELF']) == 'reports.php' ? 'active' : '' ?>">      
          <a href="reports.php">
         <i class="fas fa-chart-column"></i>
         التقارير
         </a>
       </li>
       <li>
         <a href="users.php">
         <i class="fas fa-users"></i>
         المستخدمون
         </a>
       </li>

        <li class="<?= basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : '' ?>">
          <a href="settings.php">
            <i class="fas fa-gear"></i>
            الإعدادات
          </a>
        </li>

    </ul>

</div>

<div class="main-content">

    <div class="topbar">

        <div class="search-box">

            <i class="fas fa-search"></i>

            <input type="text" placeholder="ابحث عن معاملة...">
            

        </div>

      <div class="topbar-right">

         <i class="fas fa-bell notification"></i>

         <div class="user-info">

          <i class="fas fa-user-circle"></i>

          <span><?= $_SESSION['full_name']; ?></span>

      </div>

       <a href="logout.php" class="btn btn-danger btn-sm">
        <i class="fas fa-right-from-bracket"></i>
        تسجيل الخروج
       </a>

     </div>

</div>

    <h1 class="page-title">
        لوحة التحكم</h1>
    <div class="cards">

     <div class="card">
        <i class="fas fa-folder"></i>
        <h3><?= $total ?></h3>
        <p>إجمالي المعاملات</p>
     </div>

     <div class="card">
        <i class="fas fa-spinner"></i>
        <h3><?= $pending ?></h3>
        <p>قيد التنفيذ</p>
     </div>

     <div class="card">
        <i class="fas fa-circle-check"></i>
        <h3><?= $finished ?></h3>
        <p>منتهية</p>
     </div>

     <div class="card">
        <i class="fas fa-box-archive"></i>
        <h3><?= $archive ?></h3>
        <p>مؤرشفة</p>
     </div>

    </div>
    </h1>
    <div class="table-box">

     <div class="table-header">

        <h2>أحدث المعاملات</h2>

        <a href="add_transaction.php" class="add-btn">
         <i class="fas fa-plus"></i>
           إضافة معاملة
       </a>
     </div> 

    </div>

    <table>

        <thead>

            <tr>

                <th>رقم المعاملة</th>

                <th>الموضوع</th>

                <th>صادرة - واردة</th>
                
                <th>الجهة</th>

                <th>التاريخ</th>

                <th>الحالة</th>

                <th>الإجراءات</th>

            </tr>

        </thead>

        <tbody>
            <?php while($row = mysqli_fetch_assoc($latest)){ ?>

         <tr>

         <td><?= $row['transaction_number']; ?></td>

         <td><?= $row['subject']; ?></td>

         <td><?= $row['transaction_type']; ?></td>

         <td><?= $row['sender']; ?></td>

         <td><?= $row['transaction_date']; ?></td>

         <td>

         <?php

         if($row['status']=="قيد التنفيذ"){

            echo '<span class="status pending">قيد التنفيذ</span>';

         }

         elseif($row['status']=="منتهية"){

            echo '<span class="status done">منتهية</span>';

         }

         elseif($row['status']=="مؤرشفة"){

            echo '<span class="status archive">مؤرشفة</span>';

         }

         else{

            echo '<span class="status new">جديدة</span>';

         }

         ?>

         </td>

         <td>

         <a href="view_transaction.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-eye"></i>
         </a>

         <a href="edit_transaction.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">
            <i class="fas fa-pen"></i>
         </a>

         <a href="delete_transaction.php?id=<?= $row['id']; ?>"
           class="btn btn-danger btn-sm"
           onclick="return confirm('هل تريد حذف المعاملة؟')">
            <i class="fas fa-trash"></i>
         </a>

         </td>

         </tr>

         <?php } ?>
         
         
        </tbody>

    </table>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="assets/JS/script.js"></script> 

</body>

</html>