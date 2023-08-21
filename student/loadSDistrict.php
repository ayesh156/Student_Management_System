<?php

require "../connection.php";

if (isset($_GET["p"])) {
    $province_id = $_GET["p"];

    $s_district = Database::search("SELECT * FROM `district` WHERE `province_id` = '" . $province_id . "' ");
    $s_dis_num = $s_district->num_rows;

    if ($s_dis_num > 0) {


        for ($d = 0; $d < $s_dis_num; $d++) {

            $s_dis_data =  $s_district->fetch_assoc();
?>

            <option value="<?php echo $s_dis_data["id"]; ?>"><?php echo $s_dis_data["district"]; ?></option>

        <?php
        }
    } else {

        $district_rs = Database::search("SELECT * FROM `district`");

        $district_num = $district_rs->num_rows;

        for ($d = 0; $d < $district_num; $d++) {
            $district_data = $district_rs->fetch_assoc();
        ?>

            <option value="<?php echo $district_data["id"]; ?>"><?php echo $district_data["district"]; ?></option>

<?php
        }
    }
}

?>