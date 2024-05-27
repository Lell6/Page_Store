<?php
    require_once("../0_service/databaseSessionTemplate.php");
    require_once('../0_service/orderManagement.php');    
    require_once("../0_service/printAndRedirect.php");

    $pdo = connectToDatabase();
    $serviceOrder = new Order();
    $path = 'mainStore/index.php';

    $orderId = $_SESSION['orderToExecute']['orderId'];
    $productsInOrder = $_SESSION['orderToExecute']['products'];

    $serviceOrder->cancelOrder($orderId);
    unset($_SESSION['orderToExecute']);
    
    printAndRedirect("Zamówienie zostało anulowane", $path);
    exit();
?>