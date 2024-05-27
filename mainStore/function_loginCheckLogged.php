<?php  
    require_once("../0_service/userData.php");

    $serviceUserData = new UserData();
    $serviceUserData->checkLoggedUser();
?>