<?php

require "../connection.php";

$uname = $_POST["e"];
$password = $_POST["p"];
$grade = $_POST["p"];

if (empty($uname)) {
    echo ("1");
} else if (empty($password)) {
    echo ("2");
} else {

    $invoice_id = uniqid();

    $stu_rs = Database::search("SELECT * FROM `student` INNER JOIN `student_details` ON student.email = student_details.student_email INNER JOIN `city` ON student_details.city_id = city.id WHERE `user_name`='" . $uname . "' AND `password` = '" . $password . "' ");
    $stu_num = $stu_rs->num_rows;

    if ($stu_num == 1) {

        $stu_data = $stu_rs->fetch_assoc();

        $array["id"] = $invoice_id;
        $array["item"] = "Enrollment payment";
        $array["amount"] = 2000;
        $array["fname"] = $stu_data["first_name"];
        $array["lname"] = $stu_data["last_name"];
        $array["mobile"] = $stu_data["mobile"];
        $array["address"] = $stu_data["address"];
        $array["city"] = $stu_data["city"];
        $array["mail"] = $stu_data["email"];

        echo json_encode($array);
    } else {
        echo ("3");;
    }
}
