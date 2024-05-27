<?php
    require_once("../0_service/userData.php");
    checkedLogged('admin');

    require_once("../0_service/printAndRedirect.php");

    $id = $_GET['id'];
    $path = "admin/loadTemplate_formPage_edit_worker.php?id=.$id";
    checkPost($path);

    require_once("../0_service/databaseSessionTemplate.php");
    $pdo = connectToDatabase();

    $values_worker = Array(
        'Name' => isset($_POST['name']) ? $_POST['name'] : "",
        'Surname' => isset($_POST['surname']) ? $_POST['surname'] : "",
        'Email' => isset($_POST['email']) ? $_POST['email'] : "",
        'PhoneNumber' => isset($_POST['phone']) ? $_POST['phone'] : ""
    );
    
    if($values_worker['PhoneNumber'] != "" && !preg_match('/^[0-9]{9}$/', $values_worker['PhoneNumber'])){
        printAndRedirect("Nieprawidłowy Numer komórkowy", $path);
        exit();
    }

    $values_user = Array(
        'Login' => isset($_POST['login']) ? $_POST['login'] : "",
        'Privilege' => isset($_POST['privilege']) ? $_POST['privilege'] : ""
    );

    foreach($values_worker as $key => $value){
        if($value != ""){
            $query = "UPDATE workers
                      SET $key = :$key
                      WHERE workers.Id = :id;";
            $query = $pdo->prepare($query);
            $query->execute([
                ":$key" => $value,
                ':id' => $id
            ]);
        }
    }

    $query = "SELECT workers.Id, workers.userId
              FROM workers
              INNER JOIN users ON userId = users.Id
              WHERE users.Id = :id;";
    $query = $pdo->prepare($query);
    $query->execute([
        ':id' => $id
    ]); 
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $id = $result['userId'];

    foreach($values_user as $key => $value){
        if($value != ""){
            $query = "UPDATE users
                      SET $key = :$key
                      WHERE users.Id = :id;";
            $query = $pdo->prepare($query);
            $query->execute([
                ":$key" => $value,
                ':id' => $id
            ]);
        }
    }

    $password = isset($_POST['password']) ? $_POST['password'] : "";
    if($password != ""){
        $query = "UPDATE users
                  SET `Password` = SHA2(:password, 256)
                  WHERE users.Id = :id;";
        $query = $pdo->prepare($query);
        $query->execute([
            ":password" => $password,
            ':id' => $id
        ]);
    }

    printAndRedirect("Pracownik został zaktualizowany", $path);
?>