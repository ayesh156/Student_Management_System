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

        $order_id = $invoice_id;
        $merchant_secret = "MjgwNzA5MTUxMjMwMzcyMzQ2ODQzMTE2NzkxNjg1MjQzNjc5MDQyMQ==";
        $currency = "LKR";
        $merchant_id = 1221178;
        $amount = 2000;

        $hash = strtoupper(
            md5(
                $merchant_id .
                    $order_id .
                    number_format($amount, 2, '.', '') .
                    $currency .
                    strtoupper(md5($merchant_secret))
            )
        );

        $array["id"] = $invoice_id;
        $array["item"] = "Enrollment payment";
        $array["amount"] = $amount;
        $array["fname"] = $stu_data["first_name"];
        $array["lname"] = $stu_data["last_name"];
        $array["mobile"] = $stu_data["mobile"];
        $array["address"] = $stu_data["address"];
        $array["city"] = $stu_data["city"];
        $array["mail"] = $stu_data["email"];
        $array["hash"] = $hash;

        echo json_encode($array);
    } else {
        echo ("3");;
    }
}
