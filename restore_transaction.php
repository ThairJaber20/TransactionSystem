<?php
include "includes/db.php";

$id = $_GET['id'];

mysqli_query($conn, "UPDATE transactions SET status='جديدة' WHERE id='$id'");

header("Location: archive.php");
exit;
?>