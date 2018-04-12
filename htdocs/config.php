<?php

    session_start();

    require_once "GoogleAPI/vendor/autoload.php";
    $gClient = new Google_Client();
    $gClient->setClientId("815251135942-nekrqggknj2dem1rfuhs1hi4me9att0r.apps.googleusercontent.com");
    $gClient->setClientSecret("rya5MBBnyTGYIIRVB0OjQsVg");
    $gClient->setApplicationName("Mess Review Portal");
    $gClient->setRedirectUri("http://localhost/callback.php");
    $gClient->setScopes(array("https://www.googleapis.com/auth/plus.login", "https://www.googleapis.com/auth/userinfo.email"));

?>