<?php

session_start();
require "../connection.php";

if(!empty($_POST["v"])){

    $uname = $_POST["uname"];
    $v = $_POST["v"];

    $stu = Database::search("SELECT * FROM `student` WHERE `user_name` = '" . $uname . "' AND `verification_code`='".$v."' ");
    $num = $stu -> num_rows;

    if($num == 1){
        $data = $stu -> fetch_assoc();
        $stu_rs = Database::search("SELECT * FROM `student_details` WHERE `student_email`='".$data["email"]."' ");
        $stu_data = $stu_rs -> fetch_assoc();

        $_SESSION["s"] = $stu_data;

        Database::iud("UPDATE `student` SET `status_id` = '1' WHERE `email` = '".$data["email"]."' ");

        echo ("Success");

    }else{
        echo ("Invalid verification code");
    }

}else {
    echo ("Please enter your verification code");
}

?>