<?php
    require_once("../0_service/userData.php");
    checkedLogged('work');

    require_once("../0_service/databaseSessionTemplate.php");
    $pdo = connectTodatabase();
    $template = setTemplate("../admin/templates/page_productImages.twig");

    $id = $_GET['id'];
    $query = "SELECT * FROM products WHERE products.Id = :id";
    $query = $pdo->prepare($query);
    $query->execute([
        ":id" => $id
    ]);
    
    if($query->fetch(PDO::FETCH_ASSOC)){
        $imagesPath = "../mainStore/images/products_images/".$id;
        $imageList = [];

        foreach(scandir($imagesPath) as $image){
            if ($image == '.' || $image == '..') { continue; }
            $imageList[] = $imagesPath . "/" . $image;
        }
    }

    $timeStamp = time();

    echo $template->render(['images' => $imageList, 'time' => $timeStamp]);
?>