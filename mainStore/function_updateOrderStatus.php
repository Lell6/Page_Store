<?php    
    require_once("../0_service/orderManagement.php");
    require_once("../0_service/databaseSessionTemplate.php");
    require_once("../0_service/printAndRedirect.php");

    requireSession();
    $serviceOrder = new Order();
    $serviceNavigation = new Navigation();

    if(!$_SERVER['REQUEST_METHOD'] == "POST"){
        $serviceNavigation->redirectToPage("mainStore/page_order.php");
        exit();
    }

    if(!isset($_SESSION['orderToExecute']) || $_SESSION['orderToExecute'] == []){
        $_SESSION['orderToExecute']['products'] = [];
        $_SESSION['orderToExecute']['prices'] = [];

        $_SESSION['orderToExecute']['products'] = $_SESSION['cart'];
        $_SESSION['orderToExecute']['prices'] = $_SESSION['cart_price'];
    }

    if($_SESSION['orderToExecute']['products'] != $_SESSION['cart']){
        $_SESSION['orderToExecute']['products'] = $_SESSION['cart'];
        $_SESSION['orderToExecute']['prices'] = $_SESSION['cart_price'];
    }

    $serviceNavigation->redirectToPage("mainStore/page_order.php");
?>