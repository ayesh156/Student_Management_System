<?php

session_start();
require "../connection.php";

if (!empty($_POST["uname"])) {

    if (!empty($_POST["pwd"])) {

        $uname = $_POST["uname"];
        $pwd = $_POST["pwd"];

        $student_rs = Database::search("SELECT * FROM `student` WHERE `user_name` = '" . $uname . "' AND `password` = '" . $pwd . "' ");
        $student_num = $student_rs->num_rows;

        if ($student_num > 0) {

            $student_data = $student_rs->fetch_assoc();
            $status = $student_data["status_id"];
            $option = $student_data["option_id"];
            $email = $student_data["email"];
            $jdate1 = $student_data["joined_date"];
            $payment = $student_data["payment_status_id"];

            if ($option == 2) {

                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $tdate = $d->format("Y-m-d");

                $date1 = strtotime($jdate1);
                $date2 = strtotime($tdate);

                $diff = ($date2 - $date1) / 60 / 60 / 24;

                if ($diff < 30 || $payment == 1) {

                    if ($status == 1) {

                        $stu_rs = Database::search("SELECT * FROM `student_details` WHERE `student_email`='" . $email . "' ");
                        $stu_data = $stu_rs->fetch_assoc();

                        $_SESSION["s"] = $stu_data;

                        echo ("Verified");
                    } else {

                        echo ("notVerified");
                    }
                } else {

                    echo ("pay");
                }
            } else {
                echo ("Admin has blocked this email. Please contact administrator");
            }
        } else {
            echo ("You are not a valid user");
        }
    } else {
        echo ("Password field should not be empty.");
    }
} else {
    echo ("Username field should not be empty.");
}
