<?php
    session_start();
    include("function_change_products_price_in_cart.php");

    $id = $_POST['id'];
    $key = array_search($id, array_column($_SESSION['cart'], 0));

    if($key !== false){
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    
        set_price();
        $count = count($_SESSION['cart']);
    
        $response = [];
        array_push($response, $_SESSION['cart_price']);
        array_push($response, $count);
    
        header('Content-Type: application/json');
        echo json_encode($response);
    }
?>