<!DOCTYPE html>
<html>
    <head>
        <title>Towary</title>
        <link rel="stylesheet" href="https:/fonts.googleapis.com/icon?family=Material+Icons">

        <link rel="stylesheet" href="css/style_body.css">
        <link rel="stylesheet" href="css/style_navbar.css">
        <link rel="stylesheet" href="css/style_cecha_list.css">
        <link rel="stylesheet" href="css/style_towar_list.css">
    </head>
    <body>
        <?php require("loadTemplate_elementPage_navbar.php");?>

        <div class="towary_main_content">
            <?php
                require("loadTemplate_elementPage_filtr.php");
            ?>

            <div class="towar_list">
                <?php require("loadTemplate_elementPage_productInList.php");?>
            </div>
        </div>

        <script src="js/toggle_sorting.js"></script>
        <script src="js/lazyLoad_products.js"></script>
        <script src="js/search_engine.js"></script>
    </body>
</html>