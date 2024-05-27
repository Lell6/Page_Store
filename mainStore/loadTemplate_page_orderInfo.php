<?php
    require_once("../0_service/databaseSessionTemplate.php");
    require_once('../0_service/orderManagement.php');

    requireSession();
    $template = setTemplate('templates/page_orderInfo.twig');
    $serviceOrder = new Order();

    $orderId = $_SESSION['orderToExecute']['orderId'];
    $productsInOrder = $_SESSION['orderToExecute']['products'];
    $orderPrice = $_SESSION['orderToExecute']['prices'];

    $order = $serviceOrder->getExecutedOrderById($orderId);
    $order['WholePrice'] = number_format($order['WholePrice'] / 100, 2);
    $order['DeliveryPrice'] = number_format($order['DeliveryPrice'] / 100, 2);
    $order['ProductsPrice'] = number_format($order['ProductsPrice'] / 100, 2);

    foreach($productsInOrder as &$product){
        $product[5] = number_format($product[5] / 100, 2);
    }
    echo $template->render(['order' => $order, 'products' => $productsInOrder]);
?>