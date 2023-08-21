<?php

session_start();

if(isset($_SESSION["s"])){

    $_SESSION["s"] = null;
    session_destroy();

    echo ("success");

} else {
    echo ("Something Went Wrong");
}

?>