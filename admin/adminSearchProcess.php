<?php

session_start();

require "../connection.php";

if (!empty($_POST["t"])) {

    $t = $_POST["t"];

    $query = "SELECT * FROM `admin` INNER JOIN `admin_details` ON admin.email = admin_details.admin_email INNER JOIN `gender` ON admin.gender_id = gender.id INNER JOIN `city` ON admin_details.city_id = city.id WHERE `admin`.`email` <> '" . $_SESSION["a"]["admin_email"] . "' AND `admin`.`email` LIKE '%" . $t . "%' OR `admin`.`user_name` LIKE '%" . $t . "%' OR `admin_details`.`first_name` LIKE '%" . $t . "%' OR `admin_details`.`last_name` LIKE '%" . $t . "%' ";
} else {
    $query = "SELECT * FROM `admin` INNER JOIN `admin_details` ON admin.email = admin_details.admin_email INNER JOIN `gender` ON admin.gender_id = gender.id INNER JOIN `city` ON admin_details.city_id = city.id WHERE `admin`.`email` <> '" . $_SESSION["a"]["admin_email"] . "'";
}

$admin_rs = Database::search($query);
$admin_num = $admin_rs->num_rows;

$pageno = 0;

if ("0" != ($_POST["page"])) {
    $pageno = $_POST["page"];
} else {
    $pageno = 1;
}

$results_per_page = 5;
$number_of_pages = ceil($admin_num / $results_per_page);

$page_results = ((int)$pageno - 1) * $results_per_page;
$query .= " LIMIT " . $results_per_page . " OFFSET " . $page_results . "";

$ad_rs = Database::search($query);
$ad_num = $ad_rs->num_rows;

?>

<table class="table table-bordered ">

    <thead>
        <tr>
            <th>Email</th>
            <th>U. Name</th>
            <th>Name</th>
            <th>DOB</th>
            <th>Mobile</th>
            <th>Gender</th>
            <th>City</th>

        </tr>
    </thead>
    <tbody>

        <?php

        if ($ad_num == 0) {

        ?>

            <td colspan="12">No any admins information found
            </td>

            <?php

        } else {

            for ($x = 0; $x < $ad_num; $x++) {

                $ad_details_data = $ad_rs->fetch_assoc();

            ?>
                <tr onclick="window.location = 'edit-admin.php?ad=<?php echo $ad_details_data['email']; ?>'">

                    <td><?php echo $ad_details_data["email"]; ?></td>
                    <td><?php echo $ad_details_data["user_name"]; ?></td>
                    <td><?php echo $ad_details_data["first_name"] . " " . $ad_details_data["last_name"]; ?></td>
                    <td><?php echo $ad_details_data["birthday"]; ?></td>
                    <td><?php echo $ad_details_data["mobile"]; ?></td>
                    <td><?php echo $ad_details_data["gender"]; ?></td>
                    <td><?php echo $ad_details_data["city"]; ?></td>

                </tr>

        <?php


            }
        }

        ?>

    </tbody>

</table>

<div class="col-12 text-center mb-3 mt-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" <?php if ($pageno <= 1) {
                                            echo "#";
                                        } else {
                                        ?> onclick="adminView('<?php echo ($pageno - 1); ?>');" <?php } ?>>
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php


            for ($page = 1; $page <= $number_of_pages; $page++) {
                if ($page == $pageno) {
            ?>

                    <li class="page-item active">
                        <a class="page-link" onclick="adminView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
                    </li>

                <?php
                } else {
                ?>

                    <li class="page-item">
                        <a class="page-link" onclick="adminView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
                    </li>

            <?php
                }
            }

            ?>
            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo "#";
                                        } else {
                                        ?> onclick="adminView('<?php echo ($pageno + 1); ?>');" <?php } ?>>
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</div>