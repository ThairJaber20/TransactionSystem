<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

include "includes/db.php";

// الإحصائيات
$total = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM transactions"));
$new = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM transactions WHERE status='جديدة'"));
$pending = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM transactions WHERE status='قيد التنفيذ'"));
$finished = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM transactions WHERE status='منتهية'"));
$archive = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM transactions WHERE status='مؤرشفة'"));

$result = mysqli_query($conn,"SELECT * FROM transactions ORDER BY transaction_date DESC");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

 <head>

 <meta charset="UTF-8">

 <title>التقارير</title>

 <link rel="stylesheet" href="assets/css/style.css">

 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

 </head>

 <body>

 <!-- القائمة الجانبية -->

 <div class="sidebar">

     <div class="logo">
     <h2>إدارة المعاملات</h2>
     </div>

     <ul>

         <li>
         <a href="dashboard.php">
         <i class="fas fa-home"></i>
         الرئيسية
         </a>
         </li>

         <li>
         <a href="transactions.php">
         <i class="fas fa-folder"></i>
         المعاملات
         </a>
         </li>

         <li>
         <a href="archive.php">
         <i class="fas fa-box-archive"></i>
         الأرشيف
         </a>
         </li>

         <li class="active">
         <a href="reports.php">
         <i class="fas fa-chart-column"></i>
         التقارير
         </a>
         </li>

         <li>
         <a href="users.php">
         <i class="fas fa-users"></i>
         المستخدمون
         </a>
         </li>
         <li class="<?= basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : '' ?>">
          <a href="settings.php">
            <i class="fas fa-gear"></i>
            الإعدادات
          </a>
        </li>

         </ul>

         </div>

         <!-- المحتوى -->

         <div class="main-content">

             <div class="topbar">

             <h4>التقارير</h4>

                 <div class="user-info">

                 <i class="fas fa-user-circle"></i>

                 <span><?= $_SESSION['full_name']; ?></span>

                 <a href="logout.php" class="btn btn-danger btn-sm">
                 <i class="fas fa-right-from-bracket"></i>
                  تسجيل الخروج
                 </a>

                 </div>

             </div>

         <h2 class="page-title">
         <i class="fas fa-chart-column"></i>
         تقارير المعاملات
         <a href="export_pdf.php" class="btn btn-danger">
         <i class="fas fa-file-pdf"></i>
          تصدير PDF
          </a>

         <a href="export_excel.php" class="btn btn-success">
         <i class="fas fa-file-excel"></i>
          تصدير Excel
         </a>
         </h2>
         

             <div class="cards">

                 <div class="card">
                 <i class="fas fa-folder"></i>
                 <h3><?= $total ?></h3>
                 <p>إجمالي المعاملات</p>
                 </div>

                 <div class="card">
                 <i class="fas fa-file-circle-plus"></i>
                 <h3><?= $new ?></h3>
                 <p>الجديدة</p>
                 </div>

                 <div class="card">
                 <i class="fas fa-spinner"></i>
                 <h3><?= $pending ?></h3>
                 <p>قيد التنفيذ</p>
                 </div>

                 <div class="card">
                 <i class="fas fa-circle-check"></i>
                 <h3><?= $finished ?></h3>
                 <p>المنتهية</p>
                 </div>

                 <div class="card">
                 <i class="fas fa-box-archive"></i>
                 <h3><?= $archive ?></h3>
                 <p>المؤرشفة</p>
                 </div>

               </div>
                <div class="table-box">

                 <h2>الرسم البياني لحالات المعاملات</h2>

                     <div style="width:350px; margin:auto;">
                         <canvas id="transactionsChart"></canvas>
                     </div>

               </div>
               <div class="table-box">

                 <div class="table-header">

                 <h2>تقرير جميع المعاملات</h2>

                 </div>

              <table>

                 <thead>

                     <tr>

                         <th>رقم المعاملة</th>

                         <th>الموضوع</th>

                         <th>الجهة</th>

                         <th>الحالة</th>

                         <th>التاريخ</th>

                    </tr>

                </thead>

                <tbody>

                 <?php while($row=mysqli_fetch_assoc($result)){ ?>

                 <tr>

                 <td><?= $row['transaction_number']; ?></td>

                 <td><?= $row['subject']; ?></td>

                 <td><?= $row['sender']; ?></td>

                 <td><?= $row['status']; ?></td>

                 <td><?= $row['transaction_date']; ?></td>

                 </tr>

                 <?php } ?>

                </tbody>

             </table>

         </div>

     </div>
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <script>

const ctx = document.getElementById('transactionsChart');

new Chart(ctx, {

    type: 'doughnut',

    data: {

        labels: [

            'جديدة',

            'قيد التنفيذ',

            'منتهية',

            'مؤرشفة'

        ],

        datasets: [{

            data: [

                <?= $new ?>,

                <?= $pending ?>,

                <?= $finished ?>,

                <?= $archive ?>

            ],

            backgroundColor: [

                '#3498db',

                '#f39c12',

                '#27ae60',

                '#7f8c8d'

            ]

        }]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {

                position: 'bottom'

            }

        }

    }

});

</script>
  </body>

</html>