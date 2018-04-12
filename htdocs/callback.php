<?php
    require_once "config.php";

    // If there's already a session just get the token
    if (isset($_SESSION['access_token'])) {
        $gClient->setAccessToken($_SESSION['access_token']);
    } 
    // If there is no access token get from code
    else if (isset($_GET['code'])) {
        $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
        $_SESSION['access_token'] = $token;
    }
    else {
        header('Location: http://localhost/login.php');
        exit(); 
    }

    $oAuth = new Google_Service_Oauth2($gClient);
    
    $userData = $oAuth->userinfo_v2_me->get();
    $_SESSION['email'] = $userData['email'];
    $_SESSION['familyName'] = $userData['familyName'];
    $_SESSION['givenName'] = $userData['givenName'];

    // Connecting DB
    $conn = mysqli_connect("localhost", "root", "", "Mess-Portal");
    if(mysqli_connect_errno()){
        echo 'Failed to connect to MySQL '. mysql_connect_errno();
    }
    $email = $_SESSION['email'];
    $givenName = $_SESSION['givenName'];
    $familyName = $_SESSION['familyName'];
    // Create Query
    $query = "SELECT email FROM `individual_info` WHERE email = '".$email."'";
    // Get Result
    $result = mysqli_query($conn, $query);
    // Fetch Data
    $posts = mysqli_fetch_assoc($result);
    // Free Result
    mysqli_free_result($result);
    $_SESSION['posts'] = $posts;
    
    if(count($_SESSION['posts']) == 0){
        $insert = "INSERT INTO `individual_info`( `email`, `firstname`, `lastname`, `hostel`, `rollNumber`) VALUES ('$email','$givenName','$familyName','','')";
        if(mysqli_query($conn, $insert)){
            echo 'success';
        }
        header('Location: http://localhost/info.php');
        exit();
    }
    else {
        echo "email found". $email;
        header('Location: http://localhost/main.php');
        exit();
    }
 
?>
