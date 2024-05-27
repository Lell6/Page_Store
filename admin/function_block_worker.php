<?php
    require_once("../0_service/userData.php");
    checkedLogged('admin');

    require_once("../0_service/printAndRedirect.php");
    $path = "admin/loadTemplate_page_workers.php";
    checkPost($path);

    require_once("../0_service/databaseSessionTemplate.php");
    $pdo = connectToDatabase();
    $serviceNavigator = new Navigation();

    $workerId = $_GET['id'];

    $query = "SELECT workers.Id, workers.userId
              FROM workers
              INNER JOIN users ON userId = users.Id
              WHERE users.Id = :id;";
    $query = $pdo->prepare($query);
    $query->execute([
    ':id' => $workerId
    ]); 
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $id = $result['userId'];

    $query = "UPDATE users
              SET Status = 2
              WHERE users.Id = :id";
    $query = $pdo->prepare($query);
    $query->execute([
        ':id' => $id
    ]);

    $serviceNavigator->redirectToPage($path);
?>