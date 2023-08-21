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
    echo ("Please Enter Teacher Email");
} else if (strlen($email) >= 100) {
    echo ("Email must have less than 100 characters");
} else if (empty($uname)) {
    echo ("Please Enter Teacher Username");
} else if (strlen($uname) >= 50) {
    echo ("Username must have less than 50 characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email !!!");
} else if (empty($pwd)) {
    echo ("Please enter Password !!!");
} else if (strlen($pwd) < 5 || strlen($pwd) > 20) {
    echo ("Password must be between 5 - 20 characters");
} else {

    $tch_rs = Database::search("SELECT * FROM `teacher` INNER JOIN `teacher_details` ON teacher.email = teacher_details.teacher_email WHERE `email` = '" . $email . "' OR `user_name` = '" . $uname . "' OR `teacher_email` = '" . $email . "' ");
    $tch_num = $tch_rs->num_rows;

    if ($tch_num == 0) {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d");

        $code = uniqid();
        Database::iud("INSERT INTO `teacher` (`email`,`user_name`,`password`,`joined_date`,`verification_code`,`gender_id`,`status_id`,`option_id`) VALUES ('" . $email . "','" . $uname . "','" . $pwd . "','" . $date . "','" . $code . "','1','2','2')");
        Database::iud("INSERT INTO `teacher_details` (`teacher_email`,`city_id`) VALUES ('".$email."','1')");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ayeshchathuranga531@gmail.com';
        $mail->Password = 'hqhutzzfbpovirng';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('ayeshchathuranga531@gmail.com', 'Invitations for registration Teachers');
        $mail->addReplyTo('ayeshchathuranga531@gmail.com', 'Invitations for registration Teachers');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'AlphaTech Student Management System Teacher Registration Invitation';
        $bodyContent = '<h2 style="color:green;">Your Username is ' . $uname . '</h2>
                        <h2 style="color:pink;">Your Password is ' . $pwd . '</h2>
                        <h2 style="color:blue;">Your Varification code is ' . $code . '</h2>
                        <h3>Go to this link, enter the details and register <a href="https://localhost/Student_Management_System/teacher/index.php">alphaTech.lk/teacher/login.php</a></h3>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo "Varification code sending failed";
        }else {
            echo ("Success");
        }
        
    } else {
         echo ("This Email or Username already exists");
    }

}
