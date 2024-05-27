<?php
    require_once("../0_service/userData.php");
    checkedLogged('work');

    require_once("../0_service/databaseSessionTemplate.php");
    $pdo = connectToDatabase();
    $template = setTemplate("../admin/templates/page_products.twig");

    $query = "SELECT products.Id, products.Name, products.Price, products.Description, 
              cathegory.Name AS Cathegory, 
              type.Name AS Type, 
              tax.Value AS Tax, products.SalePercent 
              FROM products 
              INNER JOIN cathegory ON products.Cathegory = cathegory.Id 
              INNER JOIN type ON products.Type = type.Id 
              INNER JOIN tax ON products.Tax = tax.Id;";

    $query = $pdo->prepare($query);
    $query->execute();

    $products = $query->fetchAll(PDO::FETCH_ASSOC);
    $keys = array_keys($products[0]);
    $keys[] = 'Features';

    foreach ($products as &$product){
        $id = $product['Id'];

        $query = "SELECT features.Name AS Feature, features.Value AS Value
                  FROM featurelist
                  INNER JOIN features ON featurelist.FeatureId = features.Id
                  WHERE featurelist.ProductId = :id;";
        $query = $pdo->prepare($query);
        $query->execute([
            ':id' => $id
        ]);

        $result = $query->fetchALL(PDO::FETCH_ASSOC);

        $mergedFeatures = [];
        foreach ($result as $row) {
            $mergedFeatures[] = $row['Feature'] . ': ' . $row['Value'];
        }     
        $product['Features'] = $mergedFeatures;
        $product['Price'] = number_format($product['Price']/100, 2);
    }

    $user['login'] = $_SESSION['login'];
    $user['privilege'] = $_SESSION['privilege'];

    echo $template->render(['keys' => $keys, 'products' => $products, 'user' => $user]);
?>