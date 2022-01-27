<?php
    session_start();
    echo "Logout Sucessful.";
    session_unset();
    session_destroy();
    header("location:welcome.php");
?>