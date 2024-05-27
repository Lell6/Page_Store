<?php 
    require("loadTemplate_page_product.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <?php
            $productClass->printProductTitle();
        ?>

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            
        <link rel="stylesheet" href="css/style_body.css">
        <link rel="stylesheet" href="css/style_navbar.css">
        <link rel="stylesheet" href="css/style_towar.css">
    </head>
        
    <body>
        <?php 
            requireSession();
            $serviceProducts = new ProductsIndatabase();
            $template = setTemplate('templates/elementPage_navbar.twig');
            
            $items = (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : '0';
            $cathegory = $serviceProducts->getProductsCathegory();
        
            echo $template->render(['items' => $items, 'cathegories' => $cathegory]);        

            $productClass->printProduct();
        ?>

        <script src="js/input_number_logic.js"></script>
        <script src="js/toggle_product_images.js"></script>
        <script src="js/search_engine.js"></script>
    </body>
</html>