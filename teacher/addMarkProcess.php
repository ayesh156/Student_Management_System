<?php

require "../connection.php";

if (isset($_POST["email"]) && isset($_POST["sasid"])) {

    $email = $_POST["email"];
    $sub_assign_id = $_POST["sasid"];
    $ass_mark = $_POST["amark"];

    $isNumber = is_numeric($ass_mark);

    if ($isNumber != 1) {
        
        echo ("Enter numbers only");

    } else {

        $sub_assign_rs = Database::search("SELECT * FROM `submitted_assignment` WHERE `student_email`='" . $email . "' AND `id`='" . $sub_assign_id . "' ");
        $sub_assign_num = $sub_assign_rs->num_rows;

        if ($sub_assign_num > 0) {

            $sub_assign_data = $sub_assign_rs->fetch_assoc();

            Database::iud("UPDATE `submitted_assignment` SET `marks`='" . $ass_mark . "' WHERE `student_email`='" . $email . "' AND `id`='" . $sub_assign_id . "' ");

            echo ("Success");
        } else {
            echo ("Cannot find the assignment. Please try again later.");
        }
    }
} else {
    echo ("Something went wrong.");
}
