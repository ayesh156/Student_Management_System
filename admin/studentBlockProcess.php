<?php

require "../connection.php";

if(isset($_GET["email"])){

    $email = $_GET["email"];

    $student_rs = Database::search("SELECT * FROM `student` WHERE `email`='".$email."' ");
    $student_num = $student_rs -> num_rows;

    if($student_num == 1){
        
        $student_data = $student_rs -> fetch_assoc();

        if($student_data["option_id"] == 2){
            Database::iud("UPDATE `student` SET `option_id`='1' WHERE `email`='".$email."' ");
            echo ("blocked");
        }else if($student_data["option_id"] == 1){
            Database::iud("UPDATE `student` SET `option_id`='2' WHERE `email`='".$email."' ");
            echo ("unblocked");
        }

    }else{
        echo ("Cannot find the student. Please try again later.");
    }

}else{
    echo ("Something went wrong.");
}

?>