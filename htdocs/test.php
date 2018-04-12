<?php
    require('config/db.php');
    $email = 'adc@gmail.com' ;
    // Create Query
    $query = 'SELECT email FROM individual_info WHERE email = "$email"';
    // Get Result
    $result = mysqli_query($conn, $query);
    // Fetch Data
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // Free Result
    mysqli_free_result($result);

    if(count($posts) == 0){
        // echo $email;
        $insert = "INSERT INTO `individual_info`( `email`, `firstname`, `lastname`, `hostel`, `rollNumber`) VALUES ('$email','','','','')";
        if(mysqli_query($conn, $insert)){
            echo 'success';
        }
    }

?>
