<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include "includes/header.php";
include "includes/sidebar.php";
?>

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header bg-success text-white">

            <h4 class="mb-0">
                <i class="fas fa-database"></i>
                النسخ الاحتياطي
            </h4>

        </div>

        <div class="card-body">

            <div class="alert alert-info">

                يمكنك إنشاء نسخة احتياطية من قاعدة البيانات في أي وقت.

            </div>

            <a href="create_backup.php"
               class="btn btn-success btn-lg">

                <i class="fas fa-download"></i>

                إنشاء نسخة احتياطية

            </a>

        </div>

    </div>

</div>

<?php include "includes/footer.php"; ?>