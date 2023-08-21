<?php

session_start();

require "../connection.php";

if (isset($_SESSION["t"])) {

    $temail = $_SESSION["t"]["teacher_email"];
    $subject = $_POST["sj"];
    $grade = $_POST["gd"];
    $lesson = $_POST["ls"];
    $description = $_POST["desc"];

    if (empty($lesson)) {
        echo ("Please Enter Lesson name");
    } else if (empty($description)) {
        echo ("Please Enter Description");
    } else if (!isset($_FILES["note"])) {
        echo ("Please Upload Note");
    } else {

        $ghs_rs = Database::search("SELECT * FROM `grade_has_subject` WHERE `subject_id` = '" . $subject . "' AND `grade_id`='" . $grade . "' ");
        $ghs_num = $ghs_rs->num_rows;

        if ($ghs_num > 0) {

            $note = $_FILES["note"];

            $allowed_file_ex = array("application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/msword", "application/vnd.ms-powerpoint", "application/vnd.openxmlformats-officedocument.presentationml.presentation", "application/pdf");

            $file_ex = $note["type"];

            if (!in_array($file_ex, $allowed_file_ex)) {
                echo ("Please select a valid file.");
            } else {

                $new_file_extention;

                if ($file_ex == "application/pdf") {
                    $new_file_extention = ".pdf";
                } else if ($file_ex == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
                    $new_file_extention = ".docx";
                } else if ($file_ex == "application/msword") {
                    $new_file_extention = ".doc";
                } else if ($file_ex == "application/vnd.ms-powerpoint") {
                    $new_file_extention = ".ppt";
                } else if ($file_ex == "application/vnd.openxmlformats-officedocument.presentationml.presentation") {
                    $new_file_extention = ".pptx";
                }

                $file_name = "../images/lesson_note/" . $lesson . "_" . uniqid() . $new_file_extention;

                move_uploaded_file($note["tmp_name"], $file_name);

                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d");

                $ghs_data = $ghs_rs->fetch_assoc();

                Database::iud("INSERT INTO `lesson_note` (`name`,`description`,`path`,`date_added`,`grade_has_subject_id`,`teacher_email`) VALUES ('" . $lesson . "','" . $description . "','" . $file_name . "','" . $date . "','" . $ghs_data["id"] . "','" . $temail . "') ");

                echo ("Success");
            }
        } else {
            echo ("This subject is not in the given grade");
        }
    }
    
} else {
    header("Location:index.php");
}
