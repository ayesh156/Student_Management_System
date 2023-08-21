<?php

session_start();

if(isset($_SESSION["t"])){

    $_SESSION["t"] = null;
    session_destroy();

    echo ("success");

} else {
    echo ("Something Went Wrong");
}

?>