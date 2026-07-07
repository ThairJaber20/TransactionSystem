<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include "includes/db.php";
include "includes/header.php";
include "includes/sidebar.php";
?>

<div class="container-fluid mt-4">

    <div class="card shadow">

        <div class="card-header bg-success text-white">

            <h4 class="mb-0">
                <i class="fas fa-gear"></i>
                إعدادات النظام
            </h4>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-3 text-center">

                    <img src="assets/images/logo.png" width="150" class="mb-3">

                    <h5>وزارة البيئة والمياه والزراعة</h5>

                    <p class="text-muted">
                        نظام إدارة المعاملات
                    </p>

                    <hr>

                    <p>
                        <strong>الإصدار :</strong><br>
                        Version 1.0
                    </p>

                </div>

                <div class="col-md-9">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-success">

                            <tr>

                                <th width="70%">الإعداد</th>

                                <th width="30%" class="text-center">
                                    الإجراء
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>

                                    <i class="fas fa-key text-warning"></i>

                                    تغيير كلمة المرور

                                    <br>

                                    <small class="text-muted">
                                        تغيير كلمة مرور الحساب الحالي.
                                    </small>

                                </td>

                                <td class="text-center">

                                    <a href="change_password.php"
                                       class="btn btn-warning">

                                        <i class="fas fa-edit"></i>

                                        فتح

                                    </a>

                                </td>

                            </tr>

                            <tr>

                                <td>

                                    <i class="fas fa-database text-success"></i>

                                    النسخ الاحتياطي

                                    <br>

                                    <small class="text-muted">
                                        إنشاء نسخة احتياطية لقاعدة البيانات.
                                    </small>

                                </td>

                                <td class="text-center">

                                    <a href="backup.php"
                                       class="btn btn-success">

                                        <i class="fas fa-download"></i>

                                        فتح

                                    </a>

                                </td>

                            </tr>

                            <tr>

                                <td>

                                    <i class="fas fa-circle-info text-primary"></i>

                                    حول النظام

                                    <br>

                                    <small class="text-muted">
                                        معلومات النظام والإصدار.
                                    </small>

                                </td>

                                <td class="text-center">

                                    <a href="about.php"
                                       class="btn btn-primary">

                                        <i class="fas fa-eye"></i>

                                        فتح

                                    </a>

                                </td>

                            </tr>

                        </tbody>

                    </table>
                    <a href="dashboard.php" class="btn btn-success">
                        الرجوع الى القائمة الرئيسية
                    </a>
                </div>

            </div>

        </div>

    </div>

</div>

<?php include "includes/footer.php"; ?>