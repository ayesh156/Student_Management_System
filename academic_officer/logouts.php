<?php

session_start();

if(isset($_SESSION["ao"])){

    $_SESSION["ao"] = null;
    session_destroy();

    echo ("success");

} else {
    echo ("Something Went Wrong");
}

?>