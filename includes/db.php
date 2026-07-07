<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "transaction_system";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>