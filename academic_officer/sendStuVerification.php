<?php

require "../connection.php";
require "../SMTP.php";
require "../PHPMailer.php";
require "../Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$email = $_POST["e"];
$uname = $_POST["u"];
$pwd = $_POST["p"];

if (empty($email)) {
    echo ("Please Enter Student Email");
} else if (strlen($email) >= 100) {
    echo ("Email must have less than 100 characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email !!!");
} else if (empty($pwd)) {
    echo ("Please enter Password !!!");
} else if (strlen($pwd) < 5 || strlen($pwd) > 20) {
    echo ("Password must be between 5 - 20 characters");
} else if (empty($uname)) {
    echo ("Please Enter Student Username");
} else if (strlen($uname) >= 50) {
    echo ("Username must have less than 50 characters");
} else {

    $stu_rs = Database::search("SELECT * FROM `student` WHERE `email` = '" . $email . "' AND `password` = '" . $pwd . "' AND `user_name` = '" . $uname . "' ");
    $stu_num = $stu_rs->num_rows;

    if ($stu_num > 0) {

        $stu_data = $stu_rs -> fetch_assoc();
        $code = $stu_data["verification_code"];

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ayeshchathuranga531@gmail.com';
        $mail->Password = 'hqhutzzfbpovirng';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('ayeshchathuranga531@gmail.com', 'Invitations for Logging Students');
        $mail->addReplyTo('ayeshchathuranga531@gmail.com', 'Invitations for Logging Students');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'AlphaTech Student Management System Student Varification';
        $bodyContent = '<h2 style="color:green;">Your Username is ' . $uname . '</h2>
                        <h2 style="color:pink;">Your Password is ' . $pwd . '</h2>
                        <h2 style="color:blue;">Your Varification code is ' . $code . '</h2>
                        <h3>Go to this link, enter the details and logging <a href="https://localhost/Student_Management_System/student/index.php">alphaTech.lk/student/login.php</a></h3>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo "Varification code sending failed";
        } else {
            echo ("Success");
        }

    } else {
         echo ("Please Register First!");
    }

}
