<?php

require "../connection.php";
require "../SMTP.php";
require "../PHPMailer.php";
require "../Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (!empty($_POST["input"])) {
    $input = $_POST["input"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $input . "' OR `user_name` = '" . $input . "' ");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num > 0) {

        $admin_data = $admin_rs -> fetch_assoc();
        $email = $admin_data["email"];
        $code = uniqid();

        Database::iud("UPDATE `admin` SET `verification_code`='" . $code . "' WHERE `email`='" . $email . "' ");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ayeshchathuranga531@gmail.com';
        $mail->Password = 'hqhutzzfbpovirng';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('ayeshchathuranga531@gmail.com', 'Admin Verification');
        $mail->addReplyTo('ayeshchathuranga531@gmail.com', 'Admin Verification');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'eShop Admin Login Verification Code';
        $bodyContent = '<h1 style="color:blue;">Your Verification code is ' . $code . '</h1>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo "Varification code sending failed";
        } else {
            echo "Success";
        }

    } else {
        echo ("You are not a valid user");
    }
} else {
    echo ("Email field should not be empty.");
}
