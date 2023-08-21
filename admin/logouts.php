<?php

session_start();

if(isset($_SESSION["a"])){

    $_SESSION["a"] = null;
    session_destroy();

    echo ("success");

} else {
    echo ("Something Went Wrong");
}

?>