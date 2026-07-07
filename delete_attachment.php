<?php
include "includes/db.php";

$id = $_GET['id'];

// جلب بيانات الملف
$result = mysqli_query($conn, "SELECT * FROM attachments WHERE id='$id'");
$file = mysqli_fetch_assoc($result);

if($file){

    // حذف الملف من مجلد uploads
    if(file_exists($file['file_path'])){
        unlink($file['file_path']);
    }

    // حذف السجل من قاعدة البيانات
    mysqli_query($conn, "DELETE FROM attachments WHERE id='$id'");

    // الرجوع إلى صفحة المعاينة
    header("Location: view_transaction.php?id=".$file['transaction_id']);
    exit;
}
?>