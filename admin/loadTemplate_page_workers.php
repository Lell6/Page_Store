<?php
    require_once("../0_service/userData.php");
    checkedLogged('admin');
    
    require_once("../0_service/databaseSessionTemplate.php");
    $pdo = connectToDatabase();
    $template = setTemplate('../admin/templates/page_workers.twig');

    $query = "SELECT workers.Id, workers.Name, workers.Surname, workers.PhoneNumber, workers.Email, 
                     users.Login, users.Privilege, users.Status, privilege.Name AS Privilege, userstatus.Name AS Status
              FROM workers
              INNER JOIN users ON workers.userId = users.Id
              INNER JOIN userstatus ON users.Status = userstatus.Id
              INNER JOIN privilege ON users.Privilege = privilege.Id;";

    $query = $pdo->prepare($query);
    $query->execute();

    $workers = $query->fetchAll(PDO::FETCH_ASSOC);
    $keys = array_keys($workers[0]);

    $user['login'] = $_SESSION['login'];
    $user['privilege'] = $_SESSION['privilege'];

    echo $template->render(['keys' => $keys, 'workers' => $workers, 'user' => $user]);
?>