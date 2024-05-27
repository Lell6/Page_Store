<?php
    $value = $_POST['search'];
    
    require_once("../0_service/databaseSessionTemplate.php");
    $pdo = connectToDatabase();

    $query = "SELECT products.Id, products.Name, products.Price, products.Description, 
              cathegory.Name AS Cathegory, 
              type.Name AS Type, 
              tax.Value AS Tax, products.SalePercent 
              FROM products 
              INNER JOIN cathegory ON products.Cathegory = cathegory.Id 
              INNER JOIN type ON products.Type = type.Id 
              INNER JOIN tax ON products.Tax = tax.Id
              WHERE products.Name LIKE :value;";
    $query = $pdo->prepare($query);
    $query->execute([
        ':value' => "%".$value."%"
    ]);

    $products = $query->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($products);
?>