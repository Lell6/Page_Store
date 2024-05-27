<?php
    if(!$_SERVER['REQUEST_METHOD'] == "POST"){
        $serviceNavigation->redirectToPage("page_product_list.php");
        exit();
    }
    require_once('../0_service/databaseSessionTemplate.php');
    require_once('../0_service/products.php');

    $sortMethod = isset($_POST['sortMethod']) ? $_POST['sortMethod'] : 'grow';
    $serviceProductControl = new ProductsIndatabase();

    $cathegory = isset($_GET['cath']) ? $_GET['cath'] : "";
    $feature = isset($_GET['feature']) ? $_GET['feature'] : "";    
    $min = (isset($_POST['min_price']) && !empty($_POST['min_price'])) ? intval($_POST['min_price']) * 100 : 0;
    $max = (isset($_POST['max_price']) && !empty($_POST['max_price'])) ? intval($_POST['max_price']) * 100 : 999999999999;

    $products = $serviceProductControl->getProductsByCathegoryAndPriceOrderBy($cathegory, $sortMethod, $min, $max, $feature);

    $template = setTemplate('templates/elementPage_productInList.twig');
    $link = htmlspecialchars($_SERVER['REQUEST_URI']);

    if($min == 0){ $min = ""; }
    else{ $min /= 100; }

    if($max == 999999999999){ $max = ""; }
    else{ $max /= 100; }

    $time = time();

    if($cathegory == ""){
        $productsInIndex = array_slice($products, 0, 6);
        echo $template->render(['products' => $productsInIndex, 'link' => $link, 'cathegory' => $cathegory, 'sort' => $sortMethod, 'time' => $time, 'feature' => $feature]);
    }
    else{    
        echo $template->render(['products' => $products, 'link' => $link, 'cathegory' => $cathegory, 'sort' => $sortMethod, 'min' => $min, 'max' => $max, 'time' => $time, 'feature' => $feature]);
    }
?>