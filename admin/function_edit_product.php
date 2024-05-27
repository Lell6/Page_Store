<?php
    require_once("../0_service/userData.php");
    checkedLogged('work');
    
    $productId = $_GET['id'];
    require_once("../0_service/printAndRedirect.php");
    $path = "admin/loadTemplate_formPage_edit_product.php?id=".$productId;
    checkPost($path);

    require_once("../0_service/databaseSessionTemplate.php");
    $pdo = connectToDatabase();
    
    $valuesProduct = Array(
        'Name' => isset($_POST['name']) ? $_POST['name'] : "",
        'Price' => isset($_POST['price']) ? $_POST['price'] : "",
        'Description' => isset($_POST['description']) ? $_POST['description'] : "",
        'SalePercent' => isset($_POST['percent']) ? $_POST['percent'] : "",
        'Cathegory' => $_POST['category'],
        'Type' => $_POST['type'],
        'Tax' => $_POST['tax']
    );

    require_once("../0_service/products.php");
    $serviceProducts = new ProductsInDatabase();
    $foundedProduct = $serviceProducts->getProductByName($valuesProduct['Name']);
    if($foundedProduct){
        printAndRedirect("Towar z taką nazwą jest w bazie", $path);
        exit();
    }

    $price = &$valuesProduct['Price'];

    if(!empty($price)){
        if(str_contains($price, ',')){
            $price = str_replace(',', '.', $price);
        }
    
        if(is_numeric($price)){
            $price = number_format(floatval($price)*100, 0, '.', '');
        }
        else{
            printAndRedirect("Nieprawidłowa cena",  $path);
            exit();
        }
    }

    function getLastInsertedId($pdo){
        $query = "SELECT LAST_INSERT_ID();";
        $query = $pdo->prepare($query);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result['LAST_INSERT_ID()'];
    }

    foreach($valuesProduct as $key => $value){
        if($value != ""){
            $query = "UPDATE products
                      SET $key = :$key
                      WHERE products.Id = :id;";
            $query = $pdo->prepare($query);
            $query->execute([
                ":$key" => $value,
                ':id' => $productId
            ]);
        }
    }

    $features = [];
    for($i = 0; $i < 4; $i++){
        $featureName = 'feature'.$i;
        $featureId = 'featureId'.$i;
        $featureId = isset($_POST[$featureId]) ? $_POST[$featureId] : "";

        $features[$featureId] = isset($_POST[$featureName]) ? $_POST[$featureName] : "";
    }

    foreach($features as $oldFeatureId => $featureInfo){
        if(empty($featureInfo)){
            continue;
        }

        $featureNameValue = explode(" ", $featureInfo);
        $featureName = $featureNameValue[0];
        $featureValue = $featureNameValue[1];

        $query = "SELECT features.Id FROM features WHERE Name=:name AND Value=:value";
        $query = $pdo->prepare($query);
        $query->execute([
            ':name' => $featureName,
            ':value' => $featureValue
        ]);

        $result = $query->fetch(PDO::FETCH_ASSOC);
        if(empty($result['Id'])){
            $query = "INSERT INTO features (`Name`, `Value`) VALUES (:name, :value)";
            $query = $pdo->prepare($query);
            $query->execute([
                ':name' => $featureName,
                ':value' => $featureValue
            ]);

            $featureId = getLastInsertedId($pdo);
        }
        else{
            $featureId = $result['Id'];
        }
        
        $query = "UPDATE featurelist
                  SET `FeatureId` = :featureId
                  WHERE `ProductId` = :productId
                  AND `FeatureId` = :oldFeatureId;";

        $query = $pdo->prepare($query);
        $query->execute([
            ':productId' => $productId,
            ':featureId' => $featureId,
            ':oldFeatureId' => $oldFeatureId
        ]);
    }
    
    if(isset($_FILES['files']) && !empty(array_filter($_FILES['files']['name']))){
        require_once("../0_service/imageControl.php");
        $serviceImageControl = new ImageControl();

        $serviceImageControl->removeImagesInFolder($productId);
        $serviceImageControl->getImages($_FILES, $productId);
        $serviceImageControl->iterateThroughImagesAndAdd();
    }

    printAndRedirect("Towar został zredagowany", $path);
?>