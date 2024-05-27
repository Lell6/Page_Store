<?php
    session_start();
    $products_price = 0;
    $delivery = intval($_POST['price']) * 100;

    foreach($_SESSION['cart'] as $product){
        $price = ($product[2])*$product[4];
        $products_price += $price;
    }

    $whole_price = $products_price + $delivery;
    $_SESSION['cart_price'] = [$products_price, $delivery, $whole_price];

    $prices = [];
    foreach($_SESSION['cart_price'] as $price){
        $prices[] = number_format($price / 100, 2); 
    }

    header('Content-Type: application/json');
    echo json_encode($prices);
?>