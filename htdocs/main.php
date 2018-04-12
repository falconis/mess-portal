<?php

    session_start();

    // Connecting DB
    $conn = mysqli_connect("localhost", "root", "", "Mess-Portal");
    if(mysqli_connect_errno()){
        echo 'Failed to connect to MySQL '. mysql_connect_errno();
    }

    // If user is not authorised redirect to login page
    if(!isset($_SESSION['access_token'])) {
        header('Location: login.php');
        exit();
    }

    // Checks POST request
    if(isset($_POST['submit'])){
        // GET from data
        $breakfast = mysqli_real_escape_string($conn, $_POST['breakfast']);
        $lunch = mysqli_real_escape_string($conn, $_POST['lunch']);
        $snacks = mysqli_real_escape_string($conn, $_POST['snacks']);
        $dinner = mysqli_real_escape_string($conn, $_POST['dinner']);
        $cleanliness = mysqli_real_escape_string($conn, $_POST['cleanliness']);
        $rollNumber = mysqli_real_escape_string($conn, $_SESSION['rollNumber']);
        $hostel = mysqli_real_escape_string($conn, $_SESSION['hostel']);
        $insert = "INSERT INTO `ratings`( `rollNumber`, `hostel`, `breakfast`, `lunch`, `snacks`, `dinner`, `cleanliness`) VALUES ('$rollNumber','$hostel','$breakfast','$lunch','$snacks', '$dinner', '$cleanliness')";
        if(mysqli_query($conn, $insert)){
            header('Location: stats.php');
            exit();
        }
        else {
            echo 'ERROR:'. mysqli_error($conn);
        }
    }
    // Fetching data from individual info table
    $email = $_SESSION['email'];
    // Create Query
    $query = "SELECT * FROM `individual_info` WHERE email = '".$email."'";
    // Get Result
    $result = mysqli_query($conn, $query);
    // Fetch Data
    $posts = mysqli_fetch_assoc($result);
    // Free Result
    mysqli_free_result($result);
    $_SESSION['rollNumber'] = $posts['rollNumber'];
    $_SESSION['hostel'] = $posts['hostel'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mess Portal</title>
</head>
<body>
    <h1>Info Update Page!</h1>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        Breakfast: <input type="number" name="breakfast" placeholder="breakfast">
        Lunch: <input type="number" name="lunch" placeholder="lunch">
        Snacks: <input type="number" name="snacks" placeholder="snacks">
        Dinner: <input type="number" name="dinner" placeholder="dinner">
        Overall Cleanliness: <input type="number" name="cleanliness" placeholder="cleanliness">
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>