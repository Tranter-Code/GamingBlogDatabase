<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "21187515";

    //create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    //check connection
    if (!$conn) {
        die("Connection failed");
    }