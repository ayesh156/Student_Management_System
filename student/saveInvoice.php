<?php

require "../connection.php";

$mail = $_POST["m"];
$amount = $_POST["a"];
$g_id = $_POST["g"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `student_grade_payment` (`amount`,`date_paid`,`grade_id`,`student_email`,`payment_status_id`) VALUES ('" . $amount . "','" . $date . "','" . $g_id . "','" . $mail . "','1')");

Database::iud("UPDATE `student` SET `grade_id`='".$g_id."' WHERE `email`='" . $mail . "' ");

echo ("Success");
