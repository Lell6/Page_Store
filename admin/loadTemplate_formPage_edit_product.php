<?php
    require_once("../0_service/userData.php");
    checkedLogged('work');
    
    require_once("../0_service/databaseSessionTemplate.php");
    requireSession();
    $pdo = connectToDatabase();
    $template = setTemplate('../admin/templates/formPage_edit_product.twig');

    $id = $_GET['id'];

    $query = "SELECT cathegory.Name FROM cathegory;";
    $query = $pdo->prepare($query);
    $query->execute();
    $cathegory = $query->fetchALL(PDO::FETCH_ASSOC);
    unset($cathegory[4]);

    $query = "SELECT type.Name FROM type;";
    $query = $pdo->prepare($query);
    $query->execute();
    $type = $query->fetchALL(PDO::FETCH_ASSOC);

    $query = "SELECT tax.Value FROM tax;";
    $query = $pdo->prepare($query);
    $query->execute();
    $tax = $query->fetchALL(PDO::FETCH_ASSOC);


    $query = "SELECT products.Id, products.Name, products.Price, products.Description,
              cathegory.Name AS Cathegory, 
              type.Name AS Type, 
              tax.Value AS Tax, products.SalePercent 
              FROM products 
              INNER JOIN cathegory ON products.Cathegory = cathegory.Id 
              INNER JOIN type ON products.Type = type.Id 
              INNER JOIN tax ON products.Tax = tax.Id
              WHERE products.Id = :id;";

    $query = $pdo->prepare($query);
    $query->execute([
        ':id' => $id
    ]);

    $product = $query->fetch(PDO::FETCH_ASSOC);
    $product['Price'] = number_format($product['Price']/100, 2);

    $query = "SELECT featurelist.featureId 
              FROM featurelist
              WHERE featurelist.productId = :id;";
    $query = $pdo->prepare($query);
    $query->execute([
        ':id' => $id
    ]);

    $featuresID = $query->fetchAll(PDO::FETCH_ASSOC);

    $query = "SELECT Features.Id, features.Name, features.Value
              FROM features
              WHERE features.Id = :id";
    $query = $pdo->prepare($query);

    foreach($featuresID as $featureId){
        $query->execute([
            ':id' => $featureId['featureId']
        ]);

        $result = $query->fetch(PDO::FETCH_ASSOC);
        $feature['Id'] = $result['Id'];
        $feature['Info'] = $result['Name'] . " " . $result['Value'];

        $features[] = $feature;
    }

    $imagesPath = "../mainStore/images/products_images/".$id;
    $imageList = [];

    foreach(scandir($imagesPath) as $image){
        if ($image == '.' || $image == '..' || !strpos($image, '.jpg')) { continue; }
        $imageList[] = $imagesPath . "/" . $image;
    }

    $timeStamp = time();

    echo $template->render([
        'product' => $product, 
        'features' => $features,
        'categories' => $cathegory, 
        'types' => $type, 
        'taxes' => $tax,
        'images' => $imageList,
        'time' => $timeStamp
    ]);
?>