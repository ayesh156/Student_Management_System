<?php

session_start();
require "../connection.php";

if(!empty($_POST["v"])){

    $uname = $_POST["uname"];
    $v = $_POST["v"];

    $tch = Database::search("SELECT * FROM `teacher` WHERE `user_name` = '" . $uname . "' AND `verification_code`='".$v."' ");
    $num = $tch -> num_rows;

    if($num == 1){
        $data = $tch -> fetch_assoc();
        $tch_rs = Database::search("SELECT * FROM `teacher_details` WHERE `teacher_email`='".$data["email"]."' ");
        $tch_data = $tch_rs -> fetch_assoc();

        $_SESSION["t"] = $tch_data;

        Database::iud("UPDATE `teacher` SET `status_id` = '1' WHERE `email` = '".$data["email"]."' ");

        echo ("Success");

    }else{
        echo ("Invalid verification code");
    }

}else {
    echo ("Please enter your verification code");
}

?>