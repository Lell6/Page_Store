<?php 
    require_once('../0_service/databaseSessionTemplate.php');
    require_once('../0_service/products.php');
    requireSession();

    $serviceProducts = new ProductsIndatabase();
    $template = setTemplate('../mainStore/templates/elementPage_navbar.twig');
    
    $items = (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : '0';
    $cathegory = $serviceProducts->getProductsCathegory();

    echo $template->render(['items' => $items, 'cathegories' => $cathegory]);
?>