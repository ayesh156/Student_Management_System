<?php

require "../connection.php";

$mail = $_POST["m"];
$amount = $_POST["a"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `enrollment_payment` (`amount`,`date_paid`,`student_email`,`payment_status_id`) VALUES ('" . $amount . "','" . $date . "','" . $mail . "','1')");

Database::iud("UPDATE `student` SET `payment_status_id`='1' WHERE `email`='" . $mail . "' ");

echo ("Success");
