<?php
include "includes/db.php";

$result = mysqli_query($conn, "SELECT * FROM transactions WHERE status='مؤرشفة' ORDER BY id DESC");
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

<title>الأرشيف</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">

</head>

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
          <li>
         <a href="users.php">
         <i class="fas fa-users"></i>
         المستخدمون
         </a>
         </li>
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

<h2>المعاملات المؤرشفة</h2>


     
</div> 
<table>
    <form method="GET" class="mb-4">

    <div class="input-group">

        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="ابحث برقم المعاملة أو الموضوع أو الجهة..."
            value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">

        <button class="btn btn-success" type="submit">

            <i class="fas fa-search"></i>
            بحث

        </button>

    </div>

</form>

    <tr> 
    <th>ID</th>
     <th>رقم المعاملة</th>
     <th>الموضوع</th>
     <th>صادرة - واردة</th>         
     <th>الجهة</th>
     <th>الحالة</th>
     <th>التاريخ</th>
     <th>التحكم</th> </tr>
     <?php
     while($row = mysqli_fetch_assoc($result)){ ?>
     <tr> 
     <td><?= $row['id']; ?></td>
     <td><?= $row['transaction_number']; ?></td>
     <td><?= $row['subject']; ?></td>
     <td><?= $row['transaction_type']; ?></td>
     <td><?= $row['sender']; ?></td>
     <td><?= $row['status']; ?></td>
     <td><?= $row['transaction_date']; ?></td>
      
    <td>

<a href="view_transaction.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">
    <i class="fas fa-eye"></i>
</a>

<a href="restore_transaction.php?id=<?= $row['id']; ?>"
   class="btn btn-success btn-sm"
   onclick="return confirm('هل تريد استعادة هذه المعاملة؟')">
    <i class="fas fa-rotate-left"></i>
</a>

</td>
 </tr> <?php } ?>
 </table>

 


</body>
</html>