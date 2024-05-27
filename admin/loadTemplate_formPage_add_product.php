<?php
    require_once("../0_service/userData.php");
    checkedLogged('work');
    
    require_once("../0_service/databaseSessionTemplate.php");
    $pdo = connectToDatabase();
    $template = setTemplate('../admin/templates/formPage_add_product.twig');

    $query = "SELECT cathegory.Name FROM cathegory WHERE cathegory.Name <> 'Wszystkie'";
    $query = $pdo->prepare($query);
    $query->execute();
    $cathegory = $query->fetchALL(PDO::FETCH_ASSOC);

    $query = "SELECT type.Name FROM type";
    $query = $pdo->prepare($query);
    $query->execute();
    $type = $query->fetchALL(PDO::FETCH_ASSOC);

    $query = "SELECT tax.Value FROM tax";
    $query = $pdo->prepare($query);
    $query->execute();
    $tax = $query->fetchALL(PDO::FETCH_ASSOC);

    echo $template->render(['categories' => $cathegory, 'types' => $type, 'taxes' => $tax]);
?>