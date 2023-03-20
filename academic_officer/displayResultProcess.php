<?php

require "../connection.php";

if(isset($_GET["email"]) & isset($_GET["aid"])){

    $email = $_GET["email"];
    $aid = $_GET["aid"];

   $result_rs = Database::search("SELECT * FROM `submitted_assignment` WHERE `student_email`='".$email."' AND `assignment_id` = '".$aid."' ");
   $result_num =$result_rs -> num_rows;

    if($result_num == 1){
        
       $result_data =$result_rs -> fetch_assoc();

        if($result_data["as_display_status_id"] == 2){
            Database::iud("UPDATE `submitted_assignment` SET `as_display_status_id`='1' WHERE `student_email`='".$email."' AND `assignment_id` = '".$aid."' ");
            echo ("Release");
        }else if($result_data["as_display_status_id"] == 1){
            Database::iud("UPDATE `submitted_assignment` SET `as_display_status_id`='2' WHERE `student_email`='".$email."' AND `assignment_id` = '".$aid."' ");
            echo ("notRelease");
        }

    }else{
        echo ("Cannot find the result. Please try again later.");
    }

}else{
    echo ("Something went wrong.");
}

?>