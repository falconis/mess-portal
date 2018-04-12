<?php

    session_start();

    $conn = mysqli_connect("localhost", "root", "", "mess-portal");
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
        $email = mysqli_real_escape_string($conn, $_SESSION['email']);
        $hostel = mysqli_real_escape_string($conn, $_POST['hostel']);
        $rollNumber = mysqli_real_escape_string($conn, $_POST['rollNumber']);
        $_SESSION['rollNumber'] = $rollNumber;
        $_SESSION['hostel'] = $hostel;
        $query = "UPDATE individual_info SET 
                    hostel ='".$hostel."',".
                    "rollNumber = '".$rollNumber."'".
                    " WHERE email = '".$email."'";
        if(mysqli_query($conn, $query)){
            echo $query;
            header('Location: main.php');
        }
        else {
            echo 'ERROR:'. mysqli_error($conn);
        }
    }
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
        Hostel: <input type="text" name="hostel" placeholder="hostel">
        Roll Number: <input type="text" name="rollNumber" placeholder="roll number">
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>