<?php
include "includes/db.php";

// التحقق من وجود رقم المعاملة
if(!isset($_GET['id'])){
    header("Location: transactions.php");
    exit;
}

$id = $_GET['id'];

// عند الضغط على حفظ
if(isset($_POST['update'])){

    $number  = $_POST['transaction_number'];
    $subject = $_POST['subject'];
    $sender  = $_POST['sender'];
    $status  = $_POST['status'];

    $sql = "UPDATE transactions SET
            transaction_number='$number',
            subject='$subject',
            sender='$sender',
            status='$status'
            WHERE id='$id'";

    mysqli_query($conn, $sql);

    header("Location: transactions.php");
    exit;
}

// جلب بيانات المعاملة
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

<title>تعديل المعاملة</title>

<link rel="stylesheet" href="assets/css/style.css">

<style>

body{
    font-family:Tahoma;
    background:#f4f6f9;
}

.form-box{
    width:500px;
    margin:40px auto;
    background:#fff;
    padding:30px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}

.form-box h2{
    margin-bottom:20px;
}

.form-group{
    margin-bottom:18px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-weight:bold;
}

.form-group input,
.form-group select{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:8px;
}

.btn{
    background:#0d7c3f;
    color:#fff;
    border:none;
    padding:12px 20px;
    border-radius:8px;
    cursor:pointer;
}

.btn:hover{
    background:#0a6834;
}

</style>

</head>

<body>

<div class="form-box">

<h2>تعديل المعاملة</h2>

<form method="POST">

<div class="form-group">
<label>رقم المعاملة</label>
<input type="text" name="transaction_number"
value="<?= $row['transaction_number']; ?>" required>
</div>

<div class="form-group">
<label>الموضوع</label>
<input type="text" name="subject"
value="<?= $row['subject']; ?>" required>
</div>

<div class="form-group">
<label>الجهة</label>
<input type="text" name="sender"
value="<?= $row['sender']; ?>" required>
</div>

<div class="form-group">
<label>الحالة</label>

<select name="status">

<option value="جديدة"
<?= ($row['status']=="جديدة") ? "selected" : ""; ?>>
جديدة
</option>

<option value="قيد التنفيذ"
<?= ($row['status']=="قيد التنفيذ") ? "selected" : ""; ?>>
قيد التنفيذ
</option>

<option value="منتهية"
<?= ($row['status']=="منتهية") ? "selected" : ""; ?>>
منتهية
</option>

<option value="مؤرشفة"
<?= ($row['status']=="مؤرشفة") ? "selected" : ""; ?>>
مؤرشفة
</option>

</select>

</div>

<button type="submit" name="update" class="btn">
حفظ التعديلات
</button>

</form>

</div>

</body>
</html>