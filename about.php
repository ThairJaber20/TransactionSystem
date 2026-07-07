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
                <i class="fas fa-circle-info"></i>
                حول النظام
            </h4>
        </div>

        <div class="card-body">

            <div class="text-center mb-4">

                <img src="assets/images/logo.png" width="150">

                <h3 class="mt-3 text-success">
                    وزارة البيئة والمياه والزراعة
                </h3>

                <p class="text-muted">
                    نظام إدارة المعاملات
                </p>

            </div>

            <table class="table table-bordered">

                <tr>
                    <th width="30%">اسم النظام</th>
                    <td>نظام إدارة المعاملات</td>
                </tr>

                <tr>
                    <th>الجهة</th>
                    <td>وزارة البيئة والمياه والزراعة</td>
                </tr>

                <tr>
                    <th>الإصدار</th>
                    <td>Version 1.0</td>
                </tr>

                <tr>
                    <th>لغة البرمجة</th>
                    <td>PHP 8 + MySQL</td>
                </tr>

                <tr>
                    <th>واجهة النظام</th>
                    <td>Bootstrap 5 + Font Awesome</td>
                </tr>

                <tr>
                    <th>سنة المشروع</th>
                    <td>2026</td>
                </tr>

            </table>

            <div class="text-center mt-4">

                <a href="settings.php" class="btn btn-success">
                    <i class="fas fa-arrow-right"></i>
                    الرجوع للإعدادات
                </a>

            </div>

        </div>

    </div>

</div>

<?php include "includes/footer.php"; ?>