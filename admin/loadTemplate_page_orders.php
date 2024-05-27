<?php
    require_once("../0_service/userData.php");
    checkedLogged('work');

    $template = setTemplate("../admin/templates/page_orders.twig");

    require_once('../0_service/orderManagement.php');
    $serviceOrder = new Order();
    
    $orders = $serviceOrder->getAllOrders();
    $keys = ["Id", "CustomerData", "ContactInfo", "Address", "WholePrice", "DeliveryPrice", "Payment", "Shipment", "DateTime", "OrderStatus", "Commentary"];

    $user['login'] = $_SESSION['login'];
    $user['privilege'] = $_SESSION['privilege'];

    echo $template->render(['orders' => $orders, 'keys' => $keys, 'user' => $user]);
?>