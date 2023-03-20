<?php

session_start();

require "../connection.php";

if (isset($_SESSION["s"])) {

    $semail = $_SESSION["s"]["student_email"];
    $ass_id = $_POST["aid"];

    if (empty($ass_id)) {
        echo ("Something went wrong");
    } else if (!isset($_FILES["answer"])) {
        echo ("Please Upload Assignment");
    } else {

        $assign_rs = Database::search("SELECT * FROM `assignment` WHERE `id` = '" . $ass_id . "'");
        $assign_num = $assign_rs->num_rows;

        if ($assign_num > 0) {

            $answer = $_FILES["answer"];

            $allowed_file_ex = array("application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/msword", "application/vnd.ms-powerpoint", "application/vnd.openxmlformats-officedocument.presentationml.presentation", "application/pdf");

            $file_ex = $answer["type"];

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

                $assign_data = $assign_rs->fetch_assoc();
                $ass_name = $assign_data["name"];

                $file_name = "../images/answer/" . $ass_name . "_" . uniqid() . $new_file_extention;

                move_uploaded_file($answer["tmp_name"], $file_name);

                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d");

                $su_assign_data_rs = Database::search("SELECT * FROM `submitted_assignment` WHERE `assignment_id`='" . $ass_id . "' AND `student_email` = '" . $_SESSION['s']['student_email'] . "' ");

                $su_assign_num = $su_assign_data_rs->num_rows;

                if($su_assign_num > 0) {

                    Database::iud("UPDATE `submitted_assignment` SET `answer_path` = '" . $file_name . "' WHERE `assignment_id`='" . $ass_id . "' AND `student_email` = '" . $_SESSION['s']['student_email'] . "' ");

                } else {

                    Database::iud("INSERT INTO `submitted_assignment` (`answer_path`,`date_submitted`,`marks`,`assignment_id`,`as_display_status_id`, `student_email`) VALUES ('" . $file_name . "','" . $date . "', '-1', '" . $ass_id . "', '2','" . $semail . "') ");

                }

                echo ("Success");
            }
        } else {
            echo ("This subject is not in the given grade");
        }
    }
} else {
    header("Location:index.php");
}
