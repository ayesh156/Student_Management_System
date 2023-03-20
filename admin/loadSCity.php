<?php

require "../connection.php";

if (isset($_GET["d"])) {
    $district_id = $_GET["d"];

    $address_rs = Database::search("SELECT * FROM `student_details` INNER JOIN `city` ON student_details.city_id=city.id INNER JOIN `district` ON city.district_id=district.id INNER JOIN `province` ON district.province_id=province.id WHERE `district_id` = '" . $district_id . "' ");
    $address_data = $address_rs->fetch_assoc();

    $stu_city = Database::search("SELECT * FROM `city` WHERE `district_id` = '" . $district_id . "' ");
    $stu_city_num = $stu_city->num_rows;

    if ($stu_city_num > 0) {

        for ($c = 0; $c < $stu_city_num; $c++) {

            $stu_city_data =  $stu_city->fetch_assoc();
?>

            <option value="<?php echo $stu_city_data["id"]; ?>" <?php if (!empty($address_data["city_id"])) {
                                                                    if ($stu_city_data["id"] == $address_data["city_id"]) {
                                                                ?>selected<?php
                                                                        }
                                                                    } ?>><?php echo $stu_city_data["city"]; ?></option>

        <?php
        }
    } else {

        $city_rs = Database::search("SELECT * FROM `city`");
        $city_num = $city_rs->num_rows;

        for ($c = 0; $c < $city_num; $c++) {
            $city_data = $city_rs->fetch_assoc();
        ?>

            <option value="<?php echo $city_data["id"]; ?>" <?php if (!empty($address_data["city_id"])) {
                                                                if ($city_data["id"] == $address_data["city_id"]) {
                                                            ?>selected<?php
                                                                    }
                                                                } ?>><?php echo $city_data["city"]; ?></option>

<?php
        }
    }
}

?>