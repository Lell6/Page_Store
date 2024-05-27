<?php
    if(!$_SERVER["REQUEST_METHOD"] == "POST"){
        exit();
    }

    require_once("../0_service/userData.php");
    require_once("../0_service/printAndRedirect.php");
    require_once("../0_service/login.php");

    $serviceUserData = new UserData();
    $serviceLogin = new Login();

    $login = $_POST['login'];
    $password = $_POST['password'];

    $foundedUser = $serviceUserData->getUserFromDatabase($login, $password);

    if($foundedUser){
        $serviceLogin->loginWithoutVerification($foundedUser);
        
        /*$serviceUserData->setTempUserInSession($foundedUser);

        $randomNumber = strval(rand(1000000, 9999999));
        $_SESSION['verificationKey'] = $randomNumber;

        $userId = $foundedUser['Id'];
        $email = $serviceUserData->getWorkerEmailByUserId($userId);
        $serviceCommunication->sendEmail($email, $randomNumber);
        $serviceNavigation->redirectToPage("page_verificationKeyInput.php");*/
    }
    else{
        printAndRedirect("Błąd logowania - nieprawidłowy login lub hasło", "mainStore/page_login.php");
    }
?>