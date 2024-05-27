<!DOCTYPE html>
<html>
    <head>
        <title>Dane zakupu</title>  
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <link rel="stylesheet" href="css/style_body.css">
        <link rel="stylesheet" href="css/style_navbar.css">
        <link rel="stylesheet" href="css/style_order.css">
    </head>

    <body> 
        <?php require("loadTemplate_elementPage_navbar.php");?>

        <div class="order_main_content">
            <?php require("loadTemplate_elementPage_orderForm.php")?>
        </div>
        <script src="js/toggle_fields_visibility.js"></script>
        <script src="js/button_next_check_input.js"></script>
        <script src="js/change_delivery_price.js"></script>
    </body>
</html>