<?php

session_start();

if (isset($_SESSION["s"])) {

    require "../connection.php";

    $stu_rs = Database::search("SELECT * FROM `student` WHERE `email` = '" . $_SESSION["s"]["student_email"] . "'");
    $stu_data = $stu_rs->fetch_assoc();

    if (!empty($_POST["t"])) {

        $t = $_POST["t"];

        $query = "SELECT  `assignment`.`id` AS aid, `assignment`.`name` AS aname,`assignment`.`description` AS `desc`,`assignment`.`date_added` AS da, `teacher_details`.`first_name` AS tfn, `teacher_details`.`last_name` AS tln, `grade_has_subject`.`grade_id` AS gid,`assignment`.`assignment_path` AS ap FROM `assignment` INNER JOIN `teacher` ON  assignment.teacher_email = teacher.email INNER JOIN `teacher_details` ON  assignment.teacher_email = teacher_details.teacher_email INNER JOIN `grade_has_subject` ON assignment.grade_has_subject_id = grade_has_subject.id WHERE `grade_has_subject`.`grade_id` = '" . $stu_data["grade_id"] . "' AND `assignment`.`name` LIKE '%" . $t . "%' OR `assignment`.`description` LIKE '%" . $t . "%' OR `teacher_details`.`first_name` LIKE '%" . $t . "%' OR `teacher_details`.`last_name`  LIKE '%" . $t . "%'";
        
    } else {
        $query = "SELECT  `assignment`.`id` AS aid, `assignment`.`name` AS aname,`assignment`.`description` AS `desc`,`assignment`.`date_added` AS da, `teacher_details`.`first_name` AS tfn, `teacher_details`.`last_name` AS tln, `grade_has_subject`.`grade_id` AS gid,`assignment`.`assignment_path` AS ap FROM `assignment` INNER JOIN `teacher` ON  assignment.teacher_email = teacher.email INNER JOIN `teacher_details` ON  assignment.teacher_email = teacher_details.teacher_email INNER JOIN `grade_has_subject` ON assignment.grade_has_subject_id = grade_has_subject.id WHERE `grade_has_subject`.`grade_id` = '" . $stu_data["grade_id"] . "' ";
    }

    $assignment_rs = Database::search($query);
    $assignment_num = $assignment_rs->num_rows;

    $pageno = 0;

    if ($_POST["page"] != "0") {
        $pageno = $_POST["page"];
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
                <th>Assignment</th>
                <th>Description</th>
                <th>Date Added</th>
                <th>Teacher Name</th>
                <th></th>
                <th></th>
                <th>Marks</th>
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

                    $assign_id = $assign_details_data["aid"];

                ?>


                    <tr>
                        <td><?php echo $assign_details_data["aname"]; ?></td>
                        <td><?php echo $assign_details_data["desc"]; ?></td>
                        <td><?php echo $assign_details_data["da"]; ?></td>
                        <td><?php echo $assign_details_data["tfn"] . " " . $assign_details_data["tln"]; ?></td>
                        <td>
                            <a href="download.php?file=<?php echo $assign_details_data["ap"]; ?>" class="btn2 orange">Download</a>
                        </td>

                        <?php

                        $su_assign_data_rs = Database::search("SELECT * FROM `submitted_assignment` WHERE `assignment_id`='" . $assign_details_data['aid'] . "' AND `student_email` = '" . $_SESSION['s']['student_email'] . "' ");
                        $su_assign_num = $su_assign_data_rs->num_rows;

                        ?>

                        <td>
                            <?php

                            if ($su_assign_num == 0) {
                            ?>
                                <a class="btn2 blue" onclick="uploadAnsModal(<?php echo $assign_id; ?>);">Upload</a>

                            <?php

                            } else {
                            ?>
                                <a class="btn2 blue" onclick="uploadAnsModal(<?php echo $assign_id; ?>);">Re-upload</a>
                            <?php
                            }

                            ?>
                        </td>

                        <td>

                            <?php

                            if ($su_assign_num > 0) {

                                $su_assign_data_data = $su_assign_data_rs->fetch_assoc();

                                $marks = $su_assign_data_data["marks"];
                                $adss = $su_assign_data_data["as_display_status_id"];

                                if ($marks != (-1) && $adss == 1) {

                                    echo $marks;
                                } else {
                            ?>
                                    <a class="btn2 green">Pending</a>
                                <?php
                                }
                            } else {
                                ?>
                                <a class="btn2 red">Not yet</a>
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

<?php

} else {
    header("Location:index.php");
}

?>