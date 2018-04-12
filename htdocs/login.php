<?php
    require_once "config.php";

    // If user is authorised redirect to main.php
    if(isset($_SESSION['access_token'])) {
        header('Location: main.php');
        exit();
    }

    $loginURL = $gClient->createAuthUrl();

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
    <form action="">
        <input type="button" value="Login with Google" onclick="window.location = '<?php echo $loginURL ?>';">
    </form>
</body>
</html>