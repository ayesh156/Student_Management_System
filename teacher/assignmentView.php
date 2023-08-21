<?php

require "../connection.php";

$query = "SELECT `student`.`email` AS su_email, `submitted_assignment`.`id` AS `sasid`, `student`.`user_name` AS su_n, `student_details`.`first_name` AS sfn, `student_details`.`last_name` AS sln, `assignment`.`name` AS sname,`submitted_assignment`.`date_submitted` AS ds, `teacher_details`.`first_name` AS tfn, `teacher_details`.`last_name` AS tln, `submitted_assignment`.`answer_path` AS ap, `submitted_assignment`.`marks` FROM `submitted_assignment` INNER JOIN `assignment` ON submitted_assignment.assignment_id = assignment.id INNER JOIN `student` ON student.email = submitted_assignment.student_email INNER JOIN `student_details` ON student.email = student_details.student_email INNER JOIN `teacher_details` ON assignment.teacher_email = teacher_details.teacher_email";

$assignment_rs = Database::search($query);
$assignment_num = $assignment_rs->num_rows;

$pageno = 0;

if ($_GET["page"] != "0") {
    $pageno = $_GET["page"];
} else {
    $pageno = 1;
}

$results_per_page = 5;
$number_of_pages = ceil($assignment_num / $results_per_page);

$page_results = ((int)$pageno - 1) * $results_per_page;
$query .= " LIMIT " . $results_per_page . " OFFSET " . $page_results . "";

$assign_rs = Database::search($query);
$assign_num = $assign_rs->num_rows;

?>

<table class="table table-bordered ">

    <thead>
        <tr>
            <th>U. Name</th>
            <th>Student Name</th>
            <th>Assignment</th>
            <th>Date Submitted</th>
            <th>Teacher Name</th>
            <th>Marks</th>
            <th style="text-indent: 75px;">&nbsp;</th>
        </tr>
    </thead>
    <tbody>

        <?php

        if ($assign_num == 0) {

        ?>

            <td colspan="12">No any Assignment information found
            </td>

            <?php

        } else {

            for ($x = 0; $x < $assign_num; $x++) {

                $assign_details_data = $assign_rs->fetch_assoc();

            ?>


                <tr>
                    <td><?php echo $assign_details_data["su_n"]; ?></td>
                    <td><?php echo $assign_details_data["sfn"] . " " . $assign_details_data["sln"]; ?></td>
                    <td><?php echo $assign_details_data["sname"]; ?></td>
                    <td><?php echo $assign_details_data["ds"]; ?></td>
                    <td><?php echo $assign_details_data["tfn"] . " " . $assign_details_data["tln"]; ?></td>
                    <td>
                        <?php

                        if ($assign_details_data["marks"] == -1) {
                        ?>
                            <input type="text" id="amark<?php echo $assign_details_data['su_email']; ?><?php echo $assign_details_data['sasid']; ?>" class="col-md-6 input1">
                            <a class="btn2 red col-md-offset-1 col-md-5" onclick="addMark('<?php echo $assign_details_data['su_email']; ?>',<?php echo $assign_details_data['sasid']; ?>)">Add</a>

                        <?php
                        } else {
                        ?>

                            <input type="text" id="amark<?php echo $assign_details_data['su_email']; ?><?php echo $assign_details_data['sasid']; ?>" class="col-md-6 input1" value="<?php echo $assign_details_data["marks"]; ?>">
                            <a class="btn2 red col-md-offset-1 col-md-5" onclick="addMark('<?php echo $assign_details_data['su_email']; ?>',<?php echo $assign_details_data['sasid']; ?>)">Add</a>


                        <?php
                        }

                        ?>
                    </td>
                    <td>
                        <a href="download.php?file=<?php echo $assign_details_data["ap"]; ?>" class="btn2 orange col-md-offset-1">Download</a>
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
                                        ?> onclick="assignmentView('<?php echo ($pageno - 1); ?>');" <?php } ?>>
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php


            for ($page = 1; $page <= $number_of_pages; $page++) {
                if ($page == $pageno) {
            ?>

                    <li class="page-item active">
                        <a class="page-link" onclick="assignmentView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
                    </li>

                <?php
                } else {
                ?>

                    <li class="page-item">
                        <a class="page-link" onclick="assignmentView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
                    </li>

            <?php
                }
            }

            ?>
            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo "#";
                                        } else {
                                        ?> onclick="assignmentView('<?php echo ($pageno + 1); ?>');" <?php } ?>>
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</div>