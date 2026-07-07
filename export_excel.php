<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

include "includes/db.php";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=transactions_report.xls");

$result = mysqli_query($conn,"SELECT * FROM transactions");
?>

<table border="1">

<tr style="background:#0d7c3f;color:white;">

<th>رقم المعاملة</th>
<th>الموضوع</th>
<th>الجهة</th>
<th>الحالة</th>
<th>التاريخ</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?= $row['transaction_number']; ?></td>

<td><?= $row['subject']; ?></td>

<td><?= $row['sender']; ?></td>

<td><?= $row['status']; ?></td>

<td><?= $row['transaction_date']; ?></td>

</tr>

<?php } ?>

</table>