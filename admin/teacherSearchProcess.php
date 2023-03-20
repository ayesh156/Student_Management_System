<?php

require "../connection.php";

if (!empty($_POST["t"])) {

    $t = $_POST["t"];

    $query = "SELECT * FROM `teacher` INNER JOIN `teacher_details` ON teacher.email = teacher_details.teacher_email INNER JOIN `gender` ON teacher.gender_id = gender.id INNER JOIN `city` ON teacher_details.city_id = city.id WHERE `teacher`.`email` LIKE '%" . $t . "%' OR `teacher`.`user_name` LIKE '%" . $t . "%' OR `teacher_details`.`first_name` LIKE '%" . $t . "%' OR `teacher_details`.`last_name` LIKE '%" . $t . "%' ";
} else {
    $query = "SELECT * FROM `teacher` INNER JOIN `teacher_details` ON teacher.email = teacher_details.teacher_email INNER JOIN `gender` ON teacher.gender_id = gender.id INNER JOIN `city` ON teacher_details.city_id = city.id";
}

$teacher_rs = Database::search($query);
$teacher_num = $teacher_rs->num_rows;

$pageno = 0;

if ("0" != ($_POST["page"])) {
    $pageno = $_POST["page"];
} else {
    $pageno = 1;
}

$results_per_page = 5;
$number_of_pages = ceil($teacher_num / $results_per_page);

$page_results = ((int)$pageno - 1) * $results_per_page;
$query .= " LIMIT " . $results_per_page . " OFFSET " . $page_results . "";

$teach_rs = Database::search($query);
$teach_num = $teach_rs->num_rows;

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

        if ($teach_num == 0) {

        ?>

            <td colspan="12">No any teachers information found
            </td>

            <?php

        } else {

            for ($x = 0; $x < $teach_num; $x++) {

                $teach_details_data = $teach_rs->fetch_assoc();

            ?>

                <tr>

                    <td onclick="window.location = 'edit-teacher.php?tch=<?php echo $teach_details_data['email']; ?>'"><?php echo $teach_details_data["email"]; ?></td>
                    <td onclick="window.location = 'edit-teacher.php?tch=<?php echo $teach_details_data['email']; ?>'"><?php echo $teach_details_data["user_name"]; ?></td>
                    <td onclick="window.location = 'edit-teacher.php?tch=<?php echo $teach_details_data['email']; ?>'"><?php echo $teach_details_data["first_name"] . " " . $teach_details_data["last_name"]; ?></td>
                    <td onclick="window.location = 'edit-teacher.php?tch=<?php echo $teach_details_data['email']; ?>'"><?php echo $teach_details_data["birthday"]; ?></td>
                    <td onclick="window.location = 'edit-teacher.php?tch=<?php echo $teach_details_data['email']; ?>'"><?php echo $teach_details_data["mobile"]; ?></td>
                    <td onclick="window.location = 'edit-teacher.php?tch=<?php echo $teach_details_data['email']; ?>'"><?php echo $teach_details_data["password"]; ?></td>
                    <td onclick="window.location = 'edit-teacher.php?tch=<?php echo $teach_details_data['email']; ?>'"><?php echo $teach_details_data["gender"]; ?></td>
                    <td onclick="window.location = 'edit-teacher.php?tch=<?php echo $teach_details_data['email']; ?>'"><?php echo $teach_details_data["city"]; ?></td>
                    <td>
                        <?php

                        if ($teach_details_data["option_id"] == 2) {
                        ?>
                            <a class="btn2 red" id="tb<?php echo $teach_details_data["email"]; ?>" onclick="blockTeacher('<?php echo $teach_details_data['email']; ?>')">Block</a>
                        <?php
                        } else {
                        ?>

                            <a class="btn2 blue" id="tb<?php echo $teach_details_data["email"]; ?>" onclick="blockTeacher('<?php echo $teach_details_data['email']; ?>')">Unblock</a>

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
                                        ?> onclick="teacherView('<?php echo ($pageno - 1); ?>');" <?php } ?>>
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php


            for ($page = 1; $page <= $number_of_pages; $page++) {
                if ($page == $pageno) {
            ?>

                    <li class="page-item active">
                        <a class="page-link" onclick="teacherView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
                    </li>

                <?php
                } else {
                ?>

                    <li class="page-item">
                        <a class="page-link" onclick="teacherView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
                    </li>

            <?php
                }
            }

            ?>
            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo "#";
                                        } else {
                                        ?> onclick="teacherView('<?php echo ($pageno + 1); ?>');" <?php } ?>>
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</div>