<?php

require "../connection.php";

if(isset($_GET["email"])){

    $email = $_GET["email"];

    $a_officer_rs = Database::search("SELECT * FROM `academic_officer` WHERE `email`='".$email."' ");
    $a_officer_num = $a_officer_rs -> num_rows;

    if($a_officer_num == 1){
        
        $a_officer_data = $a_officer_rs -> fetch_assoc();

        if($a_officer_data["option_id"] == 2){
            Database::iud("UPDATE `academic_officer` SET `option_id`='1' WHERE `email`='".$email."' ");
            echo ("blocked");
        }else if($a_officer_data["option_id"] == 1){
            Database::iud("UPDATE `academic_officer` SET `option_id`='2' WHERE `email`='".$email."' ");
            echo ("unblocked");
        }

    }else{
        echo ("Cannot find the Academic Officer. Please try again later.");
    }

}else{
    echo ("Something went wrong.");
}

?>