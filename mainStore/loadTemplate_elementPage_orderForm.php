<?php
    require_once("../0_service/databaseSessionTemplate.php");
    requireSession();
    $price= $_SESSION['cart_price'];

    $template = setTemplate('templates/elementPage_order.twig');
    echo $template->render(['price' => $price]);
?>