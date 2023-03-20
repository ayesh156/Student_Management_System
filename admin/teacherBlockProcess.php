<?php

require "../connection.php";

if(isset($_GET["email"])){

    $email = $_GET["email"];

    $teacher_rs = Database::search("SELECT * FROM `teacher` WHERE `email`='".$email."' ");
    $teacher_num = $teacher_rs -> num_rows;

    if($teacher_num == 1){
        
        $teacher_data = $teacher_rs -> fetch_assoc();

        if($teacher_data["option_id"] == 2){
            Database::iud("UPDATE `teacher` SET `option_id`='1' WHERE `email`='".$email."' ");
            echo ("blocked");
        }else if($teacher_data["option_id"] == 1){
            Database::iud("UPDATE `teacher` SET `option_id`='2' WHERE `email`='".$email."' ");
            echo ("unblocked");
        }

    }else{
        echo ("Cannot find the teacher. Please try again later.");
    }

}else{
    echo ("Something went wrong.");
}

?>