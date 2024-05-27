<?php
    $template = setTemplate('templates/elementPage_productInCart.twig');

    $products = $_SESSION['cart'];
    $price = $_SESSION['cart_price'];

    echo $template->render(['products' => $products, 'price' => $price]);
?>