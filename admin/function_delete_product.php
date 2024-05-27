<?php
    require_once("../0_service/userData.php");
    checkedLogged('work');
    
    require_once("../0_service/printAndRedirect.php");
    $path = "admin/loadTemplate_page_products.php";
    checkPost($path);

    require_once("../0_service/databaseSessionTemplate.php");
    $pdo = connectToDatabase();

    $id = $_GET["id"];
    $query = "SELECT * FROM products WHERE  products.Id = :id";
    $query = $pdo->prepare($query);
    $query->execute([
        ':id' => $id
    ]);

    if($query->fetch(PDO::FETCH_ASSOC)){
        $query = "DELETE FROM products WHERE products.Id = :id";
        $query = $pdo->prepare($query);
        $query->execute([
            ':id' => $id
        ]);

        $imagesPath = "../mainStore/images/products_images/".$id;
        
        require_once("../0_service/imageControl.php");
        $serviceImageControl = new ImageControl();

        $serviceImageControl->deleteFolderForImages($imagesPath);
        printAndRedirect("Towar został usunięty",  $path);
    }
?>