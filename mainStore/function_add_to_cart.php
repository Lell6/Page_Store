<?php
    session_start();
    //$_SESSION['cart'] = [];

    require_once("function_change_products_price_in_cart.php");
    require_once("../0_service/products.php");

    $id = $_GET['id'];

    $serviceProduct = new ProductsIndatabase();
    $product = $serviceProduct->getProduct($id);
    $features = $serviceProduct->getFeatures($product['Id']);

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $url = $_POST['url'];

        if($product !== null){
            $name = $product['Name'];
            $price = $product['Price'];
            $type = isset($_POST['cecha']) ? $_POST['cecha'] : '0';
            $count = isset($_POST['count']) ? $_POST['count'] : "";

            if($type == '0'){
                $type = $features[0];
            }
            if($count < 1 || $count == "" || preg_match('/[a-zA-Z]/', $count)){
                $count = 1;
            }

            $counted_price = $count * $price;
            $new_product = [$id, $name, $price, $type, $count, $counted_price];

            foreach ($_SESSION['cart'] as &$product_in_cart) {
                if(is_array($product_in_cart) && $product_in_cart[3] == $new_product[3]){
                    $product_in_cart = $new_product;
                    set_price();

                    echo '<script>window.location.href = "'.$url.'";</script>';            
                    exit();
                }
            }
            
            array_push($_SESSION['cart'], $new_product);
            set_price();
            echo '<script>window.location.href = "'.$url.'";</script>'; 
        }
        else{
            echo '<script>window.location.href = "index.php";</script>'; 
        }
    }
?>