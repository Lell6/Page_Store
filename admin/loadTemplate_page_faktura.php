<?php
    require_once("../0_service/userData.php");
    $serviceUserData = new UserData();
    $serviceUserData->checkLoggedWorker();
    
    requireSession();

    $template = setTemplate('../admin/templates/page_faktura.twig');

    require_once('../0_service/orderManagement.php');
    $serviceOrder = new Order();

    $orderId = $_GET['id'];

    $order = $serviceOrder->getExecutedOrderById($orderId);

    if(!$order){
        echo $template->render(['order' => null]);
        exit();
    }

    $order['WholePrice'] = number_format($order['WholePrice'] / 100, 2);
    $order['DeliveryPrice'] = number_format($order['DeliveryPrice'] / 100, 2);
    $order['ProductsPrice'] = number_format($order['ProductsPrice'] / 100, 2);

    $productsInOrder = $serviceOrder->getProductListInOrder($orderId);

    if($productsInOrder){
        foreach($productsInOrder as &$product){
            $product['ProductPrice'] *= $product['NumberOfProducts'];
            $product['ProductPrice'] = number_format($product['ProductPrice'] /100, 2);
        }
        echo $template->render(['order' => $order, 'products' => $productsInOrder]);
    }
    else{
        echo $template->render(['order' => null]);
    }
?>