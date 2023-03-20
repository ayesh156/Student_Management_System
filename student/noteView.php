<?php

session_start();

if (isset($_SESSION["s"])) {

    require "../connection.php";

    $stu_rs = Database::search("SELECT * FROM `student` WHERE `email` = '" . $_SESSION["s"]["student_email"] . "'");
    $stu_data = $stu_rs->fetch_assoc();

    $query = "SELECT `lesson_note`.`id` AS lid, `subject`.`sub_name`, `lesson_note`.`name` AS lname,`lesson_note`.`description` AS `desc`,`lesson_note`.`date_added` AS da, `teacher_details`.`first_name` AS tfn, `teacher_details`.`last_name` AS tln, `grade_has_subject`.`grade_id` AS gid,`lesson_note`.`path` AS lp FROM `lesson_note` INNER JOIN `teacher` ON lesson_note.teacher_email = teacher.email INNER JOIN `teacher_details` ON lesson_note.teacher_email = teacher_details.teacher_email INNER JOIN `grade_has_subject` ON lesson_note.grade_has_subject_id = grade_has_subject.id INNER JOIN `subject` ON grade_has_subject.subject_id = subject.id WHERE `grade_has_subject`.`grade_id` = '" . $stu_data["grade_id"] . "' ";

    $lesson_rs = Database::search($query);
    $lesson_num = $lesson_rs->num_rows;

    $pageno = 0;

    if ($_GET["page"] != "0") {
        $pageno = $_GET["page"];
    } else {
        $pageno = 1;
    }

    $results_per_page = 5;
    $number_of_pages = ceil($lesson_num / $results_per_page);

    $page_results = ((int)$pageno - 1) * $results_per_page;
    $query .= " LIMIT " . $results_per_page . " OFFSET " . $page_results . "";

    $lnote_rs = Database::search($query);
    $lnote_num = $lnote_rs->num_rows;

?>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>Subject</th>
                <th>Lesson</th>
                <th>Description</th>
                <th>Date Added</th>
                <th>Teacher name</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            <?php

            if ($lnote_num == 0) {

            ?>

                <td colspan="12">No any Assignment information found
                </td>

                <?php

            } else {

                for ($x = 0; $x < $lnote_num; $x++) {

                    $les_note_data = $lnote_rs->fetch_assoc();

                ?>


                    <tr>
                        <td><?php echo $les_note_data["sub_name"]; ?></td>
                        <td><?php echo $les_note_data["lname"]; ?></td>
                        <td><?php echo $les_note_data["desc"]; ?></td>
                        <td><?php echo $les_note_data["da"]; ?></td>
                        <td><?php echo $les_note_data["tfn"] . " " . $les_note_data["tln"]; ?></td>
                        <td>
                            <a href="download.php?file=<?php echo $les_note_data["lp"]; ?>" class="btn2 orange">Download</a>
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
                                            ?> onclick="noteView('<?php echo ($pageno - 1); ?>');" <?php } ?>>
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <?php


                for ($page = 1; $page <= $number_of_pages; $page++) {
                    if ($page == $pageno) {
                ?>

                        <li class="page-item active">
                            <a class="page-link" onclick="noteView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
                        </li>

                    <?php
                    } else {
                    ?>

                        <li class="page-item">
                            <a class="page-link" onclick="noteView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
                        </li>

                <?php
                    }
                }

                ?>
                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                echo "#";
                                            } else {
                                            ?> onclick="noteView('<?php echo ($pageno + 1); ?>');" <?php } ?>>
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