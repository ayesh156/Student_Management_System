<?php

session_start();

if (isset($_SESSION["s"])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="icon" href="../images/icon.svg" />

        <title>Invoice | AlphaTech</title>

        <link rel="stylesheet" href="css/invoice/bootstrap.min.css" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
        <link rel="stylesheet" href="css/invoice/invoiceStyle.css" />

    </head>

    <body style="background-color: #343A40;">

        <?php

        require "../connection.php";

        $umail = $_SESSION["s"]["student_email"];
        $amout = $_GET["a"];
        $gid = $_GET["gid"];
        $oid = $_GET["oid"];

        ?>

        <div class="my-5 page" size="A4">
            <div class="position-absolute ml-1 mt-1">
                <button class="btn btn-dark me-2" onclick="printInvoice();"><i class="bi bi-printer-fill"></i> print</button>
                <button class="btn btn-danger me-2" onclick="generatePDF();"><i class="bi bi-filetype-pdf"></i> Export as PDF</button>
            </div>
            <div class="p-5" id="page">
                <section class="top-content bb d-flex justify-content-between">
                    <div class="logo">
                        <img src="../images/logo_icon.png" class="img-fluid" alt="">
                    </div>
                    <div class="top-left">
                        <div class="graphic-path">
                            <p>Invoice</p>
                        </div>
                        <div class="position-relative">
                            <p>Invoice No. <span><?php echo $oid; ?></span></p>
                        </div>
                    </div>
                </section>

                <section class="store-user mt-2">
                    <div class="col-11">
                        <div class="row bb pb-2">
                            <div class="col-7">
                                <h3>AlphaTech <br> System</h3>
                                <p class="address">Maradana, <br>Colombo 10, <br>Sri Lanka. </p>
                                <div class="txn mt-2">alphaTech@gmail.com</div>
                            </div>
                            <div class="col-5">
                                <p>Client,</p>
                                <?php
                                $stu_rs = Database::search("SELECT * FROM `student` WHERE `email`='" . $umail . "' ");
                                $stu_data = $stu_rs->fetch_assoc();
                                ?>
                                <h3><?php echo $_SESSION["s"]["first_name"] . " " .  $_SESSION["s"]["last_name"]; ?></h3>
                                <?php

                                $ad =  $_SESSION["s"]["address"];
                                $splitData = explode(", ", $ad);
                                $adata1 = $splitData[0];
                                $adata2 = $splitData[1];

                                ?>
                                <p class="address"><?php echo $adata1; ?>, <br> <?php echo $adata2; ?>, <br>Sri Lanka. </p>
                                <div class="txn mt-2"><?php echo $umail; ?></div>
                            </div>
                        </div>
                        <div class="row extra-info pt-3">
                            <div class="col-7">

                                <?php
                                $payment_rs = Database::search("SELECT * FROM `student_grade_payment` WHERE `grade_id`='" . $gid . "' AND `student_email`='" . $umail . "'");
                                $payment_data = $payment_rs->fetch_assoc();

                                ?>
                                <p>Order Number: <br><span>#<?php echo $oid; ?></span></p>
                            </div>
                            <div class="col-5">
                                <p>Date & Time of Payment: <br><span><?php echo $payment_data["date_paid"]; ?></span></p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="product-area mt-4 mb-5">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td></td>
                                <td>#</td>
                                <td>Name</td>
                                <td>Grade</td>
                                <td>Price</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $grade_rs = Database::search("SELECT * FROM `grade` WHERE `id`='" . $gid . "'");
                            $grade_data = $grade_rs->fetch_assoc();
                            ?>
                            <tr>
                                <td>Grade Payment</td>
                                <td><?php echo $payment_data["id"]; ?></td>
                                <td><?php echo $_SESSION["s"]["first_name"] . " " . $_SESSION["s"]["last_name"]; ?></td>
                                <td><?php echo $grade_data["grade"]; ?></td>
                                <td>Rs.<?php echo $amout; ?>.00</td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <section class="balance-info">
                    <div class="row">
                        <div class="col-8">
                            <p class="m-0 font-weight-bold"> Note: </p>
                            <p>Invoice was created on a computer and is valid without the Signature and Seal.</p>
                        </div>
                        <div class="col-4">
                            <table class="table border-0 table-hover">
                                <tr>
                                    <td>Sub Total:</td>
                                    <td>Rs.<?php echo $amout; ?>.00</td>
                                </tr>
                                <tfoot>
                                    <tr>
                                        <td>GRAND TOTAL</td>
                                        <td>Rs.<?php echo $amout; ?>.00</td>
                                    </tr>
                                </tfoot>
                            </table>

                            <!-- Signature -->
                            <div class="col-12">
                                <img src="../images/invoice_img/signature.png" class="img-fluid" alt="">
                                <p class="text-center m-0"> Director Signature </p>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>


        ?>

        <script>
            function generatePDF() {
                const element = document.getElementById('page');
                html2pdf()
                    .from(element)
                    .save();

            }
        </script>

        <script src="js/myScript.js "></script>
        <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    </body>

    </html>

<?php
} else {
    header("Location:index.php");
}
