<?php

require "../connection.php";

if (isset($_GET["p"])) {
    $province_id = $_GET["p"];

    $t_district = Database::search("SELECT * FROM `district` WHERE `province_id` = '" . $province_id . "' ");
    $t_dis_num = $t_district->num_rows;

    if ($t_dis_num > 0) {


        for ($d = 0; $d < $t_dis_num; $d++) {

            $t_dis_data =  $t_district->fetch_assoc();
?>

            <option value="<?php echo $t_dis_data["id"]; ?>"><?php echo $t_dis_data["district"]; ?></option>

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