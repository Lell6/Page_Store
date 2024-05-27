<?php
    require_once("../0_service/databaseSessionTemplate.php");
    require_once('../0_service/orderManagement.php');    
    require_once("../0_service/printAndRedirect.php");

    $pdo = connectToDatabase();
    $serviceOrder = new Order();
    $path = 'mainStore/index.php';

    $orderId = $_SESSION['orderToExecute']['orderId'];
    $productsInOrder = $_SESSION['orderToExecute']['products'];

    $order = $serviceOrder->getExecutedOrderById($orderId);

    $query = "INSERT INTO faktura (OrderId, CustomerName, CustomerSurname, PhoneNumber,
                                   City,Street,HouseNumber,ApartmentNumber,
                                   WholePrice, ProductsPrice, DeliveryPrice,
                                   Payment,Shipment) 
                      VALUES (:orderId, :name, :surname, :number, 
                              :city, :street, :house, :apartment, 
                              :price, :productPrice, :deliveryPrice, 
                              :payment, :shipment);";

    $query = $pdo->prepare($query);
    $query->execute([
        ':orderId' => $orderId,
        ':name' => $order['CustomerName'],
        ':surname' => $order['CustomerSurname'],
        ':number' => $order['PhoneNumber'],
        ':city' => $order['City'],
        ':street' => $order['Street'],
        ':house' => $order['HouseNumber'],
        ':apartment' => $order['ApartmentNumber'],
        ':price' => $order['WholePrice'],
        ':productPrice' => $order['ProductsPrice'],
        ':deliveryPrice' => $order['DeliveryPrice'],
        ':payment' => $order['Payment'],
        ':shipment' => $order['Shipment']
    ]);

    $query = "SELECT LAST_INSERT_ID();";
    $query = $pdo->prepare($query);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $fakturaId =  $result['LAST_INSERT_ID()'];

    $query = "INSERT INTO productlist (ProductId, ProductName, FakturaId, NumberOfProducts, ProductType, ProductPrice) VALUES (:productId, :productName, :fakturaId, :productCount, :productType, :productPrice);";
    $query = $pdo->prepare($query);

    foreach($productsInOrder as $product){
        $productId = $product[0];
        $productName = $product[1];
        $productPrice = $product[2];
        $productType = $product[3];
        $productCount = $product[4];

        $query->execute([
            ':productId' => $productId,
            ':productName' => $productName,
            ':fakturaId' => $fakturaId,
            ':productCount' => $productCount,
            ':productType' => $productType,
            ':productPrice' => $productPrice
        ]);
    }

    $serviceOrder->updateOrder($orderId);
    unset($_SESSION['orderToExecute']);

    printAndRedirect("Zamówienie zostało podtwirdzone", $path);
    exit();
?>