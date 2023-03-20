<?php

require "../connection.php";

$email = $_POST["e"];
$uname = $_POST["u"];
$fname = $_POST["fn"];
$lname = $_POST["ln"];
$pwd = $_POST["pwd"];
$bday = $_POST["bday"];
$mobile = $_POST["m"];
$gender = $_POST["gr"];
$grade = $_POST["gd"];
$address = $_POST["a"];
$city = $_POST["c"];
$pcode = $_POST["pc"];

if(empty($email)) {
    echo ("Please enter email !!!");
}else if(strlen($email) >= 100) {
    echo ("Email must have less than 100 characters");
}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email !!!");
}else if(empty($uname)) {
    echo ("Please enter User Name !!!");
}else if(strlen($uname) > 50) {
    echo ("User Name must have less than 50 characters");
}else if(empty($fname)) {
    echo ("Please enter First Name !!!");
} else if(strlen($fname) > 50) {
    echo ("First Name must have less than 50 characters");
} else if(empty($lname)) {
    echo("Please enter Last Name !!!");
} else if(strlen($lname) > 50) {
    echo ("Last Name must have less than 50 characters");
} else if(empty($pwd)) {
    echo ("Please enter Password !!!");
} else if(strlen($pwd) < 5 || strlen($pwd) > 20) {
    echo ("Password must be between 5 - 20 characters");
} else if(empty($bday)) {
    echo ("Please enter Birthday !!!");
} else if(empty($mobile)) {
    echo ("Please enter Mobile !!!");
} else if(strlen($mobile) != 10) {
    echo ("Mobile must have 10 characters");
} else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)) {
    echo ("Invalid Mobile Number !!!");
} else if(empty($address)) {
    echo ("Please enter Address !!!");
} else if(empty($pcode)) {
    echo ("Please enter Postal code !!!");
} else {


    $rs = Database::search("SELECT * FROM `student` WHERE `email`='".$email."'");
    $n = $rs -> num_rows;

    if($n > 0) {
        echo ("This student is already registered.");
    } else {

        $vcode = uniqid();

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d");

        Database::iud("INSERT INTO `student` (`email`,`user_name`,`password`,`verification_code`,`joined_date`,`gender_id`,`status_id`,`grade_id`,`option_id`) VALUES ('".$email."','".$uname."','".$pwd."','".$vcode."','".$date."','".$gender."','2','".$grade."','2')");

        Database::iud("INSERT INTO `student_details` (`first_name`,`last_name`,`birthday`,`mobile`,`address`,`postal_code`,`student_email`,`city_id`) VALUES ('".$fname."','".$lname."','".$bday."','".$mobile."','".$address."','".$pcode."','".$email."','".$city."')");

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
        
                $file_name = "../images/student_img/" . $fname . "_" . uniqid() . $new_file_extention;
        
                move_uploaded_file($image["tmp_name"], $file_name);
        
                Database::iud("INSERT INTO `student_image` (`path`,`student_email`) VALUES ('" . $file_name . "','" . $email . "') ");
    
            }
        }

        echo ("Success");
    }

}