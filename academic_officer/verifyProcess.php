<?php

session_start();
require "../connection.php";

if(!empty($_POST["v"])){

    $uname = $_POST["uname"];
    $v = $_POST["v"];

    $officer = Database::search("SELECT * FROM `academic_officer` WHERE `user_name` = '" . $uname . "' AND `verification_code`='".$v."' ");
    $num = $officer -> num_rows;

    if($num == 1){
        $data = $officer -> fetch_assoc();
        $officer_rs = Database::search("SELECT * FROM `academic_officer_details` WHERE `academic_officer_email`='".$data["email"]."' ");
        $officer_data = $officer_rs -> fetch_assoc();

        $_SESSION["ao"] = $officer_data;

        Database::iud("UPDATE `academic_officer` SET `status_id` = '1' WHERE `email` = '".$data["email"]."' ");

        echo ("Success");

    }else{
        echo ("Invalid verification code");
    }

}else {
    echo ("Please enter your verification code");
}

?>