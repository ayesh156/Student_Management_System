<?php

require "../connection.php";

if (isset($_GET["d"])) {
    $district_id = $_GET["d"];

    $t_city = Database::search("SELECT * FROM `city` WHERE `district_id` = '" . $district_id . "' ");
    $t_city_num = $t_city->num_rows;

    if ($t_city_num > 0) {

        for ($c = 0; $c < $t_city_num; $c++) {

            $t_city_data =  $t_city->fetch_assoc();
?>

            <option value="<?php echo $t_city_data["id"]; ?>"><?php echo $t_city_data["city"]; ?></option>

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