<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';
include "includes/db.php";

$defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4',

    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/assets/fonts'
    ]),

    'fontdata' => $fontData + [
        'cairo' => [
            'R' => 'Cairo-Regular.ttf',
        ]
    ],

    'default_font' => 'cairo'
]);

$result = mysqli_query($conn, "SELECT * FROM transactions ORDER BY transaction_date DESC");

$html = '

<html dir="rtl" lang="ar">

<head>

<style>

body{
    font-family: cairo;
    direction: rtl;
    text-align: right;
}

h2,h3{
    text-align:center;
    color:#0d7c3f;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

table th{
    background:#0d7c3f;
    color:white;
    padding:10px;
    text-align:center;
}

table td{
    padding:8px;
    text-align:center;
}

.info{
    margin-top:20px;
    margin-bottom:20px;
}

</style>

</head>

<body>

<div style="text-align:center;">
    <img src="assets/images/logo.png" width="220">
</div>

<h2>وزارة البيئة والمياه والزراعة</h2>

<h3>نظام إدارة المعاملات</h3>

<hr>

<div class="info">

<strong>تاريخ التقرير :</strong> '.date("Y-m-d").'<br><br>

<strong>المستخدم :</strong> '.$_SESSION['full_name'].'

</div>

<table border="1">

<tr>

<th>رقم المعاملة</th>

<th>الموضوع</th>

<th>الجهة</th>

<th>الحالة</th>

<th>التاريخ</th>

</tr>
';

while($row = mysqli_fetch_assoc($result)){

$html .= '

<tr>

<td>'.$row['transaction_number'].'</td>

<td>'.$row['subject'].'</td>

<td>'.$row['sender'].'</td>

<td>'.$row['status'].'</td>

<td>'.$row['transaction_date'].'</td>

</tr>

';

}

$html .= '</table>';
$mpdf->SetDirectionality('rtl');
$mpdf->WriteHTML($html);

$mpdf->Output('تقرير_المعاملات.pdf','D');