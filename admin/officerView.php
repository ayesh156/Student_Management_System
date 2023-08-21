<?php

require "../connection.php";

$query = "SELECT * FROM `academic_officer` INNER JOIN `academic_officer_details` ON academic_officer.email = academic_officer_details.academic_officer_email INNER JOIN `gender` ON academic_officer.gender_id = gender.id INNER JOIN `city` ON academic_officer_details.city_id = city.id";

$a_officer_rs = Database::search($query);
$a_officer_num = $a_officer_rs->num_rows;

$pageno = 0;

if ($_GET["page"] != "0") {
    $pageno = $_GET["page"];
} else {
    $pageno = 1;
}

$results_per_page = 5;
$number_of_pages = ceil($a_officer_num / $results_per_page);

$page_results = ((int)$pageno - 1) * $results_per_page;
$query .= " LIMIT " . $results_per_page . " OFFSET " . $page_results . "";

$officer_rs = Database::search($query);
$officer_num = $officer_rs->num_rows;

?>

<table class="table table-bordered ">

    <thead>
        <tr>
            <th>Email</th>
            <th>U. Name</th>
            <th>Name</th>
            <th>DOB</th>
            <th>Mobile</th>
            <th>Password</th>
            <th>Gender</th>
            <th>City</th>
            <th style="text-indent: 75px;">&nbsp;</th>
        </tr>
    </thead>
    <tbody>

        <?php

        if ($officer_num == 0) {

        ?>

            <td colspan="12">No any academic_officers information found
            </td>

            <?php

        } else {

            for ($x = 0; $x < $officer_num; $x++) {

                $officer_details_data = $officer_rs->fetch_assoc();

            ?>

                <tr>
                    <td onclick="window.location = 'edit-officer.php?ao=<?php echo $officer_details_data['email']; ?>'"><?php echo $officer_details_data["email"]; ?></td>
                    <td onclick="window.location = 'edit-officer.php?ao=<?php echo $officer_details_data['email']; ?>'"><?php echo $officer_details_data["user_name"]; ?></td>
                    <td onclick="window.location = 'edit-officer.php?ao=<?php echo $officer_details_data['email']; ?>'"><?php echo $officer_details_data["first_name"] . " " . $officer_details_data["last_name"]; ?></td>
                    <td onclick="window.location = 'edit-officer.php?ao=<?php echo $officer_details_data['email']; ?>'"><?php echo $officer_details_data["birthday"]; ?></td>
                    <td onclick="window.location = 'edit-officer.php?ao=<?php echo $officer_details_data['email']; ?>'"><?php echo $officer_details_data["mobile"]; ?></td>
                    <td onclick="window.location = 'edit-officer.php?ao=<?php echo $officer_details_data['email']; ?>'"><?php echo $officer_details_data["password"]; ?></td>
                    <td onclick="window.location = 'edit-officer.php?ao=<?php echo $officer_details_data['email']; ?>'"><?php echo $officer_details_data["gender"]; ?></td>
                    <td onclick="window.location = 'edit-officer.php?ao=<?php echo $officer_details_data['email']; ?>'"><?php echo $officer_details_data["city"]; ?></td>
                    <td>
                        <?php

                        if ($officer_details_data["option_id"] == 2) {
                        ?>
                            <a class="btn2 red" id="ob<?php echo $officer_details_data["email"]; ?>" onclick="blockOfficer('<?php echo $officer_details_data['email']; ?>')">Block</a>
                        <?php
                        } else {
                        ?>

                            <a class="btn2 blue" id="ob<?php echo $officer_details_data["email"]; ?>" onclick="blockOfficer('<?php echo $officer_details_data['email']; ?>')">Unblock</a>

                        <?php
                        }

                        ?>
                    </td>

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
                                        ?> onclick="officerView('<?php echo ($pageno - 1); ?>');" <?php } ?>>
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php


            for ($page = 1; $page <= $number_of_pages; $page++) {
                if ($page == $pageno) {
            ?>

                    <li class="page-item active">
                        <a class="page-link" onclick="officerView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
                    </li>

                <?php
                } else {
                ?>

                    <li class="page-item">
                        <a class="page-link" onclick="officerView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
                    </li>

            <?php
                }
            }

            ?>
            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo "#";
                                        } else {
                                        ?> onclick="officerView('<?php echo ($pageno + 1); ?>');" <?php } ?>>
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</div>