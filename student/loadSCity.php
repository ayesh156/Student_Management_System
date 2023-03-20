<?php

require "../connection.php";

if (isset($_GET["d"])) {
    $district_id = $_GET["d"];

    $s_city = Database::search("SELECT * FROM `city` WHERE `district_id` = '" . $district_id . "' ");
    $s_city_num = $s_city->num_rows;

    if ($s_city_num > 0) {

        for ($c = 0; $c < $s_city_num; $c++) {

            $s_city_data =  $s_city->fetch_assoc();
?>

            <option value="<?php echo $s_city_data["id"]; ?>"><?php echo $s_city_data["city"]; ?></option>

        <?php
        }
    } else {

        $city_rs = Database::search("SELECT * FROM `city`");
        $city_num = $city_rs->num_rows;

        for ($c = 0; $c < $city_num; $c++) {
            $city_data = $city_rs->fetch_assoc();
        ?>

            <option value="<?php echo $city_data["id"]; ?>"><?php echo $city_data["city"]; ?></option>

<?php
        }
    }
}

?>