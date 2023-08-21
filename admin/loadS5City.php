<?php

require "../connection.php";

if (isset($_GET["d"])) {
    $district_id = $_GET["d"];

    $address_rs = Database::search("SELECT * FROM `academic_officer_details` INNER JOIN `city` ON academic_officer_details.city_id=city.id INNER JOIN `district` ON city.district_id=district.id INNER JOIN `province` ON district.province_id=province.id WHERE `district_id` = '" . $district_id . "' ");
    $address_data = $address_rs->fetch_assoc();

    $aco_city = Database::search("SELECT * FROM `city` WHERE `district_id` = '" . $district_id . "' ");
    $aco_city_num = $aco_city->num_rows;

    if ($aco_city_num > 0) {

        for ($c = 0; $c < $aco_city_num; $c++) {

            $aco_city_data =  $aco_city->fetch_assoc();
?>

            <option value="<?php echo $aco_city_data["id"]; ?>" <?php if (!empty($address_data["city_id"])) {
                                                                    if ($aco_city_data["id"] == $address_data["city_id"]) {
                                                                ?>selected<?php
                                                                        }
                                                                    } ?>><?php echo $aco_city_data["city"]; ?></option>

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