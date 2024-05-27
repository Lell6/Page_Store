<?php
    require_once("../0_service/orderManagement.php");
    require_once("../0_service/databaseSessionTemplate.php");
    require_once("../0_service/printAndRedirect.php");

    requireSession();
    $serviceNavigation = new Navigation();
    $serviceOrder = new Order();

    if(!isset($_SESSION['orderToExecute']) || $_SESSION['orderToExecute'] == []){
        $serviceNavigation->redirectToPage('page_cart.php');
    }

    $serviceCommunication = new Communication();

    $orderData = $_SESSION['orderToExecute'];
    $inputedData = array(
        'CustomerName' => isset($_POST['name']) ? $_POST['name'] : "",
        'CustomerSurname' => isset($_POST['surname']) ? $_POST['surname'] : "",
        'PhoneNumber' => isset($_POST['number']) ? $_POST['number'] : "",
        'Email' => isset($_POST['email']) ? $_POST['email'] : "",
        'City' => isset($_POST['city']) ? $_POST['city'] : "",
        'Street' => isset($_POST['street']) ? $_POST['street'] : "",
        'HouseNumber' => isset($_POST['num_bud']) ? $_POST['num_bud'] : "",
        'ApartmentNumber' => isset($_POST['num_apart']) ? $_POST['num_apart'] : "",
        'Shipment' => isset($_POST['ship']) ? $_POST['ship'] : "",
        'Payment' => isset($_POST['pay']) ? $_POST['pay'] : "",
        'Commentary' => isset($_POST['commentary']) ? $_POST['commentary'] : "",
    );

    foreach($inputedData as $name => $input){
        if($name == 'Commentary' || $name == 'ApartmentNumber'){
            continue;
        }

        if($input == ""){
            $serviceCommunication->printInfo("Puste pola");
            $serviceNavigation->redirectToPage('page_order.php');
            exit();
        }
    }

    $_SESSION['inputedData'] = $inputedData;
    $_SESSION['orderToExecute']['orderId'] = [];
    $_SESSION['orderToExecute']['orderId'] = $serviceOrder->setNewOrder($inputedData, $orderData);

    $serviceNavigation->redirectToPage('mainStore/loadTemplate_page_orderInfo.php');
?>