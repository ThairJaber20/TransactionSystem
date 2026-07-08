<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include "includes/db.php";

if (isset($_POST['save'])) {

    $number = $_POST['transaction_number'];
    $subject = $_POST['subject'];
    $transaction_type = $_POST['transaction_type'];
    $sender = $_POST['sender'];
    $date = $_POST['transaction_date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO transactions
    (
        transaction_number,
        subject,
        transaction_type,
        sender,
        transaction_date,
        status
    )
    VALUES
    (
        '$number',
        '$subject',
        '$transaction_type',
        '$sender',
        '$date',
        '$status'
    )";

    if (mysqli_query($conn, $sql)) {
        header("Location: transactions.php");
        exit;
    } else {
        echo "<div class='alert alert-danger m-3'>
        " . mysqli_error($conn) . "
        </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>إضافة معاملة</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h3>
<i class="fas fa-plus-circle"></i>
إضافة معاملة جديدة
</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label>رقم المعاملة</label>

<input
type="text"
name="transaction_number"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>صادرة - واردة</label>

<input
type="text"
name="transaction_type"
class="form-control"
placeholder="مثال: صادر إلى وزارة الصحة أو وارد من البلدية"
required>

</div>

<div class="col-md-6 mb-3">

<label>الموضوع</label>

<input
type="text"
name="subject"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>الجهة المرسلة</label>

<input
type="text"
name="sender"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>تاريخ المعاملة</label>

<input
type="date"
name="transaction_date"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>الحالة</label>

<select
name="status"
class="form-select">

<option>جديدة</option>
<option>قيد التنفيذ</option>
<option>منتهية</option>
<option>مؤرشفة</option>

</select>

</div>

</div>

<button
type="submit"
name="save"
class="btn btn-success">

<i class="fas fa-save"></i>

حفظ المعاملة

</button>

<a href="transactions.php" class="btn btn-secondary">

<i class="fas fa-arrow-right"></i>

رجوع

</a>

</form>

</div>

</div>

</div>

</body>

</html>