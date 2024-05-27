<?php
    require_once("../0_service/userData.php");
    checkedLogged('work');
    
    require_once("../0_service/printAndRedirect.php");
    $path = "admin/loadTemplate_formPage_add_product.php";
    checkPost($path);

    require_once("../0_service/databaseSessionTemplate.php");
    $pdo = connectToDatabase();

    require_once("../0_service/products.php");
    $name = isset($_POST['name']) ? $_POST['name'] : "";
    $serviceProducts = new ProductsInDatabase();
    $foundedProduct = $serviceProducts->getProductByName($name);
    
    if($foundedProduct){
        printAndRedirect("Towar z taką nazwą jest w bazie", $path);
        exit();
    }

    $price = isset($_POST['price']) ? $_POST['price'] : "";
    $category = $_POST['category'];
    $type = $_POST['type'];
    $tax = $_POST['tax'];

    $features = [];
    for($i = 0; $i < 4; $i++){
        $featureName = 'feature'.$i;
        $features[] = isset($_POST[$featureName]) ? $_POST[$featureName] : "";
    }

    $description = $_POST['description'];

    if(empty($name) || empty($price) || empty($category) || 
       empty($type)|| empty($tax) || 
       count(array_filter($features)) == 0 || empty($description)){
        printAndRedirect("Puste pola", $path);
        exit();
    }

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

    $serviceProducts->addProductToDatabase($name, $description, $price, $category, $type, $tax);
    $productId = $serviceProducts->getLastInsertedId($pdo);

    foreach($features as $feature){
        if(empty($feature)){
            continue;
        }

        $featureNameValue = explode(" ", $feature);
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

        $query = "INSERT INTO featurelist (`ProductId`, `FeatureId`) VALUES (:productId, :featureId)";
        $query = $pdo->prepare($query);
        $query->execute([
            ':productId' => $productId,
            ':featureId' => $featureId
        ]);
    }

    if(!empty($_FILES['files']['name'])){
        require_once("../0_service/imageControl.php");
        $serviceImageControl = new ImageControl();

        $serviceImageControl->getImages($_FILES, $productId);
        $serviceImageControl->iterateThroughImagesAndAdd();
    }

    printAndRedirect("Towar został dodany",  $path);
?>