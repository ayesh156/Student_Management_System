<?php

session_start();
require "../connection.php";

if (!empty($_POST["uname"])) {

    if (!empty($_POST["pwd"])) {

        $uname = $_POST["uname"];
        $pwd = $_POST["pwd"];

        $teacher_rs = Database::search("SELECT * FROM `teacher` WHERE `user_name` = '" . $uname . "' AND `password` = '" . $pwd . "' ");
        $teacher_num = $teacher_rs->num_rows;

        if ($teacher_num > 0) {

            $teacher_data = $teacher_rs->fetch_assoc();
            $status = $teacher_data["status_id"];
            $email = $teacher_data["email"];
            $option = $teacher_data["option_id"];

            if($option == 2) {
                if ($status == 1) {

                    $tch_rs = Database::search("SELECT * FROM `teacher_details` WHERE `teacher_email`='" . $email . "' ");
                    $tch_data = $tch_rs->fetch_assoc();
    
                    $_SESSION["t"] = $tch_data;
    
                    echo ("Verified");
                } else {
    
                    echo ("notVerified");
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
