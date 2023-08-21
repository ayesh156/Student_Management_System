<?php

require "../connection.php";

$query = "SELECT `student`.`email` AS s_email, `student`.`user_name` AS su_n, `student_details`.`first_name` AS sfn, `student_details`.`last_name` AS sln, `assignment`.`name` AS a_name, `submitted_assignment`.`marks`, `teacher_details`.`first_name` AS tfn, `teacher_details`.`last_name` AS tln, `submitted_assignment`.`as_display_status_id` AS ads, `assignment`.`id` AS a_id FROM `submitted_assignment` INNER JOIN `student` ON submitted_assignment.student_email = student.email INNER JOIN `student_details` ON student.email = student_details.student_email INNER JOIN `assignment` ON submitted_assignment.assignment_id = assignment.id INNER JOIN `teacher_details` ON assignment.teacher_email = teacher_details.teacher_email";

$result_rs = Database::search($query);
$result_num = $result_rs->num_rows;

$pageno = 0;

if ($_GET["page"] != "0") {
    $pageno = $_GET["page"];
} else {
    $pageno = 1;
}

$results_per_page = 5;
$number_of_pages = ceil($result_num / $results_per_page);

$page_results = ((int)$pageno - 1) * $results_per_page;
$query .= " LIMIT " . $results_per_page . " OFFSET " . $page_results . "";

$rs_rs = Database::search($query);
$rs_num = $rs_rs->num_rows;

?>

<table class="table table-bordered ">

    <thead>
        <tr>
            <th>Stu. Email</th>
            <th>U. Name</th>
            <th>Stu. Name</th>
            <th>Assignment Name</th>
            <th>Marks</th>
            <th>Tea. Name</th>
            <th style="text-indent: 100px;">&nbsp;</th>

        </tr>
    </thead>
    <tbody>

        <?php

        if ($rs_num == 0) {

        ?>

            <td colspan="12">No any results information found
            </td>

            <?php

        } else {

            for ($x = 0; $x < $rs_num; $x++) {

                $rs_details_data = $rs_rs->fetch_assoc();

            ?>
                <tr>

                    <td><?php echo $rs_details_data["s_email"]; ?></td>
                    <td><?php echo $rs_details_data["su_n"]; ?></td>
                    <td><?php echo $rs_details_data["sfn"] . " " . $rs_details_data["sln"]; ?></td>
                    <td><?php echo $rs_details_data["a_name"]; ?></td>
                    <td><?php echo $rs_details_data["marks"]; ?></td>
                    <td><?php echo $rs_details_data["tfn"] . " " . $rs_details_data["tln"]; ?></td>

                    <td>
                        <?php

                        if ($rs_details_data["ads"] == 2) {
                        ?>
                            <a class="btn2 green" id="rd<?php echo $rs_details_data["s_email"]; ?><?php echo $rs_details_data["a_id"]; ?>" onclick="displayResult('<?php echo $rs_details_data['s_email']; ?>',<?php echo $rs_details_data['a_id']; ?>)">Release</a>
                        <?php
                        } else {
                        ?>

                            <a class="btn2 red" id="rd<?php echo $rs_details_data["s_email"]; ?><?php echo $rs_details_data["a_id"]; ?>" onclick="displayResult('<?php echo $rs_details_data['s_email']; ?>',<?php echo $rs_details_data['a_id']; ?>)">Not Release</a>

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
                                        ?> onclick="resultView('<?php echo ($pageno - 1); ?>');" <?php } ?>>
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php


            for ($page = 1; $page <= $number_of_pages; $page++) {
                if ($page == $pageno) {
            ?>

                    <li class="page-item active">
                        <a class="page-link" onclick="resultView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
                    </li>

                <?php
                } else {
                ?>

                    <li class="page-item">
                        <a class="page-link" onclick="resultView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
                    </li>

            <?php
                }
            }

            ?>
            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo "#";
                                        } else {
                                        ?> onclick="resultView('<?php echo ($pageno + 1); ?>');" <?php } ?>>
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</div>