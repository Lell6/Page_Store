<?php
    require_once("../0_service/userData.php");
    checkedLogged('admin');
    
    require_once("../0_service/databaseSessionTemplate.php");
    requireSession();    

    $pdo = connectToDatabase();
    $template = setTemplate('../admin/templates/formPage_edit_worker.twig');

    $id = $_GET['id'];
    $query = "SELECT workers.Id, workers.Name, workers.Surname, workers.PhoneNumber, workers.Email, 
                     users.Login, users.Privilege, users.Status, privilege.Name AS Privilege, userstatus.Name AS Status
              FROM workers
              INNER JOIN users ON workers.userId = users.Id
              INNER JOIN userstatus ON users.Status = userstatus.Id
              INNER JOIN privilege ON users.Privilege = privilege.Id
              WHERE workers.Id = :id;";
    $query = $pdo->prepare($query);
    $query->execute([
        ':id' => $id
    ]);
    
    $worker = $query->fetch(PDO::FETCH_ASSOC);
    $selectedAdmin = ($worker['Privilege'] == 'Administrator') ? 'Selected' : '';
    $selectedWorker = ($worker['Privilege'] == 'Pracownik') ? 'Selected' : '';

    echo $template->render(['worker' => $worker, 'adminStat' => $selectedAdmin, 'workerStat' => $selectedWorker]);
?>