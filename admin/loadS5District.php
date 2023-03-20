<?php

require "../connection.php";

if (isset($_GET["p"])) {
    $province_id = $_GET["p"];

    $address_rs = Database::search("SELECT * FROM `academic_officer_details` INNER JOIN `city` ON academic_officer_details.city_id=city.id INNER JOIN `district` ON city.district_id=district.id INNER JOIN `province` ON district.province_id=province.id WHERE `province_id` = '" . $province_id . "' ");
    $address_data = $address_rs->fetch_assoc();

    $aco_district = Database::search("SELECT * FROM `district` WHERE `province_id` = '" . $province_id . "' ");
    $aco_dis_num = $aco_district->num_rows;

    if ($aco_dis_num > 0) {


        for ($d = 0; $d < $aco_dis_num; $d++) {

            $aco_dis_data =  $aco_district->fetch_assoc();
?>

            <option value="<?php echo $aco_dis_data["id"]; ?>" <?php if (!empty($address_data["district_id"])) {
                                                                    if ($aco_dis_data["id"] == $address_data["district_id"]) {
                                                                ?>selected<?php
                                                                        }
                                                                    } ?>><?php echo $aco_dis_data["district"]; ?></option>

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