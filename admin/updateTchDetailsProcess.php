<?php

require "../connection.php";

$email = $_POST["e"];
$uname = $_POST["u"];
$fname = $_POST["fn"];
$lname = $_POST["ln"];
$vcode = $_POST["vc"];
$pwd = $_POST["pwd"];
$bday = $_POST["bday"];
$mobile = $_POST["m"];
$gender = $_POST["gr"];
$subject = $_POST["sj"];
$status = $_POST["st"];
$address = $_POST["a"];
$city = $_POST["c"];
$pcode = $_POST["pc"];

if (isset($_FILES["image"])) {
    $image = $_FILES["image"];

    $allowed_image_ex = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
    $file_ex = $image["type"];

    if (!in_array($file_ex, $allowed_image_ex)) {
        echo ("Please select a valid image.");
    } else {

        $new_file_extention;

        if ($file_ex == "image/jpg") {
            $new_file_extention = ".jpg";
        } else if ($file_ex == "image/jpeg") {
            $new_file_extention = ".jpeg";
        } else if ($file_ex == "image/png") {
            $new_file_extention = ".png";
        } else if ($file_ex == "image/svg+xml") {
            $new_file_extention = ".svg";
        }

        $file_name = "../images/teacher_img/" . $fname . "_" . uniqid() . $new_file_extention;

        move_uploaded_file($image["tmp_name"], $file_name);

        $image_rs = Database::search("SELECT * FROM `teacher_image` WHERE `teacher_email`='" . $email . "' ");
        $image_num = $image_rs->num_rows;

        if ($image_num == 1) {

            Database::iud("UPDATE `teacher_image` SET `path`='" . $file_name . "' WHERE `teacher_email`='" . $email . "' ");
        } else {

            Database::iud("INSERT INTO `teacher_image` (`path`,`teacher_email`) VALUES ('" . $file_name . "','" . $email . "') ");
        }
    }
}

Database::iud("UPDATE `teacher` SET `user_name`='" . $uname . "',`password`='" . $pwd . "',`verification_code`='" . $vcode . "',`gender_id`='" . $gender . "',`status_id`='" . $status . "' WHERE `email`='" . $email . "' ");

Database::iud("UPDATE `teacher_has_subject` SET `subject_id`='" . $subject . "' WHERE `teacher_email`='" . $email . "' ");

Database::iud("UPDATE `teacher_details` SET `first_name`='" . $fname . "',`last_name`='" . $lname . "',`birthday`='" . $bday . "',`mobile`='" . $mobile . "',`address`='" . $address . "',`postal_code`='" . $pcode . "',`city_id`='" . $city . "' WHERE `teacher_email`='" . $email . "' ");

echo ("Success");
