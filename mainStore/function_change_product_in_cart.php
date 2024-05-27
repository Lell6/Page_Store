<?php
    session_start();
    require("function_change_products_price_in_cart.php");

    $id = $_POST['id'];
    $count = $_POST['count'];

    $key = array_search($id, array_column($_SESSION['cart'], 0));

    if($key !== false){
        $product = &$_SESSION['cart'][$key];
        $price = floatval($product[2]);
    
        $product[4] = intval($count);
        $product[5] = $count * $price;
        set_price();
    
        $response = [];
        array_push($response, $_SESSION['cart_price']);
        array_push($response, $product[5]);
    
        header('Content-Type: application/json');
        echo json_encode($response);
    }
?>