<?php

    $hostname   = "localhost";
    $username   = "root";
    $password   = "";
    $database   = "pawdoc";

    $conn = new mysqli($hostname, $username, $password, $database) or die (mysqli_error($con));
?>