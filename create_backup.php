<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "transaction_system"; // اكتب اسم قاعدة البيانات عندك

$date = date("Y-m-d_H-i-s");
$fileName = "backup_" . $date . ".sql";

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$fileName);

$command = "C:\\xampp\\mysql\\bin\\mysqldump.exe --user=$dbUser";

if($dbPass != ""){
    $command .= " --password=$dbPass";
}

$command .= " $dbName";

passthru($command);

exit;
?>