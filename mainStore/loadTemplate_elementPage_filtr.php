<?php 
    require_once('../0_service/databaseSessionTemplate.php');
    require_once('../0_service/products.php');
    requireSession();

    $serviceProducts = new ProductsIndatabase();
    $features = $serviceProducts->getFeaturesInList();
    $featuresOnPage = [];
    $cathegory = $_GET['cath'];
    
    foreach($features as $feature){
        $name = $feature['Feature'];
        $value = $feature['Value'];

        if(!isset($featuresOnPage[$name])){
            $featuresOnPage[$name] = [];
        }

        $featuresOnPage[$name][] = $value;
    }

    $template = setTemplate('templates/elementPage_filtr.twig');
    echo $template->render(['features' => $featuresOnPage, 'cathegory' => $cathegory]);
?>