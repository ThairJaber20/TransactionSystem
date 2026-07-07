<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include "includes/db.php";
include "includes/header.php";
include "includes/sidebar.php";

$message = "";

if (isset($_POST['change_password'])) {

      $current = $_POST['current_password'];
$new = $_POST['new_password'];
$confirm = $_POST['confirm_password'];

$id = $_SESSION['user_id'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
$user = mysqli_fetch_assoc($result);

if (password_verify($current, $user['password'])) {

    if ($new == $confirm) {

        $newPassword = password_hash($new, PASSWORD_DEFAULT);

        mysqli_query($conn,
        "UPDATE users
        SET password='$newPassword'
        WHERE id='$id'");

        $message = '<div class="alert alert-success">
        تم تغيير كلمة المرور بنجاح.
        </div>';

    } else {

        $message = '<div class="alert alert-danger">
        كلمة المرور الجديدة غير متطابقة.
        </div>';

    }

} else {

    $message = '<div class="alert alert-danger">
    كلمة المرور الحالية غير صحيحة.
    </div>';

}
}
?>

<div class="container mt-4">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h4>
<i class="fas fa-key"></i>
تغيير كلمة المرور
</h4>

</div>

<div class="card-body">

<?= $message ?>

<form method="POST">

<div class="mb-3">

<label class="form-label">
كلمة المرور الحالية
</label>

<input type="password"
class="form-control"
name="current_password"
required>

</div>

<div class="mb-3">

<label class="form-label">
كلمة المرور الجديدة
</label>

<input type="password"
class="form-control"
name="new_password"
required>

</div>

<div class="mb-3">

<label class="form-label">
تأكيد كلمة المرور
</label>

<input type="password"
class="form-control"
name="confirm_password"
required>

</div>

<button type="submit"
name="change_password"
class="btn btn-success">

<i class="fas fa-save"></i>

حفظ التغييرات

</button>

<a href="settings.php"
class="btn btn-secondary">

رجوع

</a>

</form>

</div>

</div>

</div>

<?php include "includes/footer.php"; ?>