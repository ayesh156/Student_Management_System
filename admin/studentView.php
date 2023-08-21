<?php

require "../connection.php";

$query = "SELECT * FROM `student` INNER JOIN `student_details` ON student.email = student_details.student_email INNER JOIN `gender` ON student.gender_id = gender.id INNER JOIN `city` ON student_details.city_id = city.id";

$student_rs = Database::search($query);
$student_num = $student_rs->num_rows;

$pageno = 0;

if ($_GET["page"] != "0") {
    $pageno = $_GET["page"];
} else {
    $pageno = 1;
}

$results_per_page = 5;
$number_of_pages = ceil($student_num / $results_per_page);

$page_results = ((int)$pageno - 1) * $results_per_page;
$query .= " LIMIT " . $results_per_page . " OFFSET " . $page_results . "";

$stu_rs = Database::search($query);
$stu_num = $stu_rs->num_rows;

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
    <tbody id="studentView">

        <?php

        if ($stu_num == 0) {

        ?>

            <td colspan="12">No any Students information found
            </td>

            <?php

        } else {

            for ($x = 0; $x < $stu_num; $x++) {

                $stu_details_data = $stu_rs->fetch_assoc();

            ?>


                <tr>

                    <td onclick="window.location = 'edit-student.php?s=<?php echo $stu_details_data['email']; ?>'"><?php echo $stu_details_data["email"]; ?></td>
                    <td onclick="window.location = 'edit-student.php?s=<?php echo $stu_details_data['email']; ?>'"><?php echo $stu_details_data["user_name"]; ?></td>
                    <td onclick="window.location = 'edit-student.php?s=<?php echo $stu_details_data['email']; ?>'"><?php echo $stu_details_data["first_name"] . " " . $stu_details_data["last_name"]; ?></td>
                    <td onclick="window.location = 'edit-student.php?s=<?php echo $stu_details_data['email']; ?>'"><?php echo $stu_details_data["birthday"]; ?></td>
                    <td onclick="window.location = 'edit-student.php?s=<?php echo $stu_details_data['email']; ?>'"><?php echo $stu_details_data["mobile"]; ?></td>
                    <td onclick="window.location = 'edit-student.php?s=<?php echo $stu_details_data['email']; ?>'"><?php echo $stu_details_data["password"]; ?></td>
                    <td onclick="window.location = 'edit-student.php?s=<?php echo $stu_details_data['email']; ?>'"><?php echo $stu_details_data["gender"]; ?></td>
                    <td onclick="window.location = 'edit-student.php?s=<?php echo $stu_details_data['email']; ?>'"><?php echo $stu_details_data["city"]; ?></td>
                    <td>
                        <?php

                        if ($stu_details_data["option_id"] == 2) {
                        ?>
                            <a class="btn2 red" id="sb<?php echo $stu_details_data["email"]; ?>" onclick="blockStudent('<?php echo $stu_details_data['email']; ?>')">Block</a>
                        <?php
                        } else {
                        ?>

                            <a class="btn2 blue" id="sb<?php echo $stu_details_data["email"]; ?>" onclick="blockStudent('<?php echo $stu_details_data['email']; ?>')">Unblock</a>

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
                                        ?> onclick="studentView('<?php echo ($pageno - 1); ?>');" <?php } ?>>
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php


            for ($page = 1; $page <= $number_of_pages; $page++) {
                if ($page == $pageno) {
            ?>

                    <li class="page-item active">
                        <a class="page-link" onclick="studentView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
                    </li>

                <?php
                } else {
                ?>

                    <li class="page-item">
                        <a class="page-link" onclick="studentView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
                    </li>

            <?php
                }
            }

            ?>
            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo "#";
                                        } else {
                                        ?> onclick="studentView('<?php echo ($pageno + 1); ?>');" <?php } ?>>
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</div>