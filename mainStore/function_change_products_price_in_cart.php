<?php
    function set_price(){
        $products_price = 0;
        $delivery = 1200;

        foreach($_SESSION['cart'] as $product){
            $price = ($product[2])*$product[4];
            $products_price += $price;
        }

        $whole_price = $products_price + $delivery;
        $_SESSION['cart_price'] = [$products_price, $delivery, $whole_price];
    }
?>