<?php
include "includes/db.php";

if(isset($_POST['transaction_id']) && isset($_FILES['attachment'])){

    $transaction_id = $_POST['transaction_id'];

    $file_name = $_FILES['attachment']['name'];
    $tmp_name  = $_FILES['attachment']['tmp_name'];

    $folder = "uploads/" . time() . "_" . $file_name;

    if(move_uploaded_file($tmp_name, $folder)){

        mysqli_query($conn,"
            INSERT INTO attachments(transaction_id,file_name,file_path)
            VALUES('$transaction_id','$file_name','$folder')
        ");

        header("Location: view_transaction.php?id=".$transaction_id);
        exit;

    }else{

        echo "فشل رفع الملف.";

    }

}else{

    echo "بيانات غير صحيحة.";

}
?>