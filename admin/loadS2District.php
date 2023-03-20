<?php

require "../connection.php";

if (isset($_GET["p"])) {
    $province_id = $_GET["p"];

    $address_rs = Database::search("SELECT * FROM `admin_details` INNER JOIN `city` ON admin_details.city_id=city.id INNER JOIN `district` ON city.district_id=district.id INNER JOIN `province` ON district.province_id=province.id WHERE `province_id` = '" . $province_id . "' ");
    $address_data = $address_rs->fetch_assoc();

    $ad_district = Database::search("SELECT * FROM `district` WHERE `province_id` = '" . $province_id . "' ");
    $ad_dis_num = $ad_district->num_rows;

    if ($ad_dis_num > 0) {


        for ($d = 0; $d < $ad_dis_num; $d++) {

            $ad_dis_data =  $ad_district->fetch_assoc();
?>

            <option value="<?php echo $ad_dis_data["id"]; ?>" <?php if (!empty($address_data["district_id"])) {
                                                                    if ($ad_dis_data["id"] == $address_data["district_id"]) {
                                                                ?>selected<?php
                                                                        }
                                                                    } ?>><?php echo $ad_dis_data["district"]; ?></option>

        <?php
        }
    } else {

        $district_rs = Database::search("SELECT * FROM `district`");

        $district_num = $district_rs->num_rows;

        for ($d = 0; $d < $district_num; $d++) {
            $district_data = $district_rs->fetch_assoc();
        ?>

            <option value="<?php echo $district_data["id"]; ?>" <?php if (!empty($address_data["district_id"])) {
                                                                    if ($district_data["id"] == $address_data["district_id"]) {
                                                                ?>selected<?php
                                                                        }
                                                                    } ?>><?php echo $district_data["district"]; ?></option>

<?php
        }
    }
}

?>