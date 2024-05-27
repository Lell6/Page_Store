<?php
    require_once("../0_service/userData.php");
    checkedLogged('admin');

    require_once("../0_service/printAndRedirect.php");
    $path = "admin/loadTemplate_formPage_add_worker.php";
    checkPost($path);

    require_once("../0_service/databaseSessionTemplate.php");
    $pdo = connectToDatabase();

    $name = isset($_POST['name']) ? $_POST['name'] : "";
    $surname = isset($_POST['surname']) ? $_POST['surname'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $phone = isset($_POST['phone']) ? $_POST['phone'] : "";

    $login = isset($_POST['login']) ? $_POST['login'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $privilege = isset($_POST['privilege']) ? $_POST['privilege'] : "";

    if(empty($name) || empty($surname) || empty($email) || empty($phone) || empty($login) || empty($password)){
        printAndRedirect("Puste pola", $path);
        exit();
    }
    if(!preg_match('/^[0-9]{9}$/', $phone)){
        printAndRedirect("Nieprawidłowy Numer komórkowy", $path);
        exit();
    }

    $query = "SELECT * FROM users WHERE `Login` = :login";
    $query = $pdo->prepare($query);
    $query->execute([
        ':login' => $login
    ]);
    if($query->fetchAll(PDO::FETCH_ASSOC) != null){
        printAndRedirect("Login jest zajęty", $path);
        exit();
    }
    
    $query = "SELECT * FROM workers WHERE `Email` = :email OR `PhoneNumber` = :phone;";
    $query = $pdo->prepare($query);    
    $query->execute([
        ':email' => $email,
        ':phone' => $phone
    ]);
    if($query->fetchAll(PDO::FETCH_ASSOC) != null){
        printAndRedirect("Email lub numer jest zajęty", $path);
        exit();
    }
    
    $query = "INSERT INTO users (`Login`, `Password`, `Privilege`) VALUES (:login, SHA2(:password, 256), :privilege);";
    $query = $pdo->prepare($query);
    $query->execute([
        ':login' => $login,
        ':password' => $password,
        ':privilege' => $privilege
    ]);

    $query = "SELECT LAST_INSERT_ID();";
    $query = $pdo->prepare($query);
    $query->execute();

    $new_user_id = $query->fetch(PDO::FETCH_NUM)[0];

    $query = "INSERT INTO workers (`UserId`,`Name`,`Surname`,`PhoneNumber`,`Email`) VALUES (:id, :name, :surname, :phone, :email);";
    $query = $pdo->prepare($query);
    $query->execute([
        ':id' => $new_user_id,
        ':name' => $name,
        ':surname' => $surname,
        ':phone' => $phone,
        ':email' => $email
    ]);

    printAndRedirect("Pracownik został dodany", $path);
?>