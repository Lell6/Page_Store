<!DOCTYPE html>
<html>
    <head>
        <title>Strona główna</title>  
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <link rel="stylesheet" href="css/style_body.css">
        <link rel="stylesheet" href="css/style_navbar.css">
        <link rel="stylesheet" href="css/style_index.css">
        <link rel="stylesheet" href="css/style_towar_list.css">
    </head>

    <body>
        <?php require("loadTemplate_elementPage_navbar.php");?>
        
        <div class="main_content">
            <div class="oferta">
                <img src="images/welcome.webp">
            </div>
            
            <div class="towar_list">
                <?php require("loadTemplate_elementPage_productInList.php");?>
            </div>
        </div>
        <script src="js/lazyLoad_products.js"></script>
        <script src="js/search_engine.js"></script>
    </body>
</html>