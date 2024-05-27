<!DOCTYPE html>
<html>
    <head>
        <title>Koszyk</title>  
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <link rel="stylesheet" href="css/style_body.css">
        <link rel="stylesheet" href="css/style_navbar.css">
        <link rel="stylesheet" href="css/style_cart.css">
    </head>

    <body>
        <?php
            require("loadTemplate_elementPage_navbar.php");
            require("loadTemplate_elementPage_productInCart.php");
        ?>
        
        <script src="js/change_input_value_in_cart.js"></script>
        <script src="js/delete_product.js"></script>
        <script src="js/search_engine.js"></script>
    </body>
</html>