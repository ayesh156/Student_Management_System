<?php

session_start();
require "../connection.php";

if (!empty($_POST["uname"])) {

    if (!empty($_POST["pwd"])) {

        $uname = $_POST["uname"];
        $pwd = $_POST["pwd"];

        $a_officer_rs = Database::search("SELECT * FROM `academic_officer` WHERE `user_name` = '" . $uname . "' AND `password` = '" . $pwd . "' ");
        $a_officer_num = $a_officer_rs->num_rows;

        if ($a_officer_num > 0) {

            $a_officer_data = $a_officer_rs->fetch_assoc();
            $status = $a_officer_data["status_id"];
            $email = $a_officer_data["email"];
            $option = $a_officer_data["option_id"];

            if ($option == 2) {

                if ($status == 1) {

                    $officer_rs = Database::search("SELECT * FROM `academic_officer_details` WHERE `academic_officer_email`='" . $email . "' ");
                    $officer_data = $officer_rs->fetch_assoc();

                    $_SESSION["ao"] = $officer_data;

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
