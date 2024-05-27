<?php
    if(!$_SERVER['REQUEST_METHOD'] == "POST"){
        exit();
    }

    require_once("../0_service/userData.php");
    require_once("../0_service/printAndRedirect.php");
    require_once("../0_service/login.php");
    
    $serviceUserData = new UserData();    
    $serviceCommunication = new Communication();
    $serviceNavigation = new Navigation();
    $serviceLogin = new Login();
    
    $inputedKey = $_POST['key'];

    require_once("../0_service/databaseSessionTemplate.php");
    requireSession();
    
    if(isset($_SESSION['verificationKey']) && $_SESSION['verificationKey'] && $_SESSION['verificationKey'] == $inputedKey){

        $_SESSION['login'] = $_SESSION['tempUser']['Login'];
        $_SESSION['privilege'] = $_SESSION['tempUser']['Privilege'];
        
        unset($_SESSION['verificationKey']);
        unset($_SESSION['tempUser']);

        $serviceLogin->logUserOnPage($login, $privilege);
        $serviceNavigation->redirectToPage("admin/loadTemplate_page_workers.php");
        exit();
    }

    unset($_SESSION['verificationKey']);
    $serviceNavigation->redirectToPage("mainStore/page_login.php");
?>