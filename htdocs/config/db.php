<?php
    $conn = mysqli_connect("localhost", "root", "", "Mess-Portal");
    if(mysqli_connect_errno()){
        echo 'Failed to connect to MySQL '. mysql_connect_errno();
    }
?>