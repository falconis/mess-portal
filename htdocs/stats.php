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

    // Fetching breakfast average from ratings table
    $hostel = $_SESSION['hostel'];
    // Create Query
    $query = "SELECT AVG(breakfast), AVG(lunch), AVG(snacks), AVG(dinner), AVG(cleanliness) FROM `ratings` WHERE hostel = '".$hostel."'";
    // Get Result
    $result = mysqli_query($conn, $query);
    // Fetch Data
    $ratings = mysqli_fetch_assoc($result);
    $breakfast = round($ratings['AVG(breakfast)'], 1);
    $lunch = round($ratings['AVG(lunch)'], 1);
    $snacks = round($ratings['AVG(snacks)'], 1);
    $dinner = round($ratings['AVG(dinner)'], 1);
    $cleanliness = round($ratings['AVG(cleanliness)'], 1);    
    // Free Result
    mysqli_free_result($result);
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
    <h1>Stats Page!</h1>
    <h2>Overall ratings</h2>
    <p>Breakfast: <?php echo $breakfast ?></p>
    <p>Lunch: <?php echo $lunch ?></p>
    <p>Snacks: <?php echo $snacks ?></p>
    <p>Dinner: <?php echo $dinner ?></p>
    <p>Overall Cleanliness: <?php echo $cleanliness ?></p>
    </form>
    <a href="./logout.php">Logout</a>
</body>
</html>