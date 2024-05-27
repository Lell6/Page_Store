<?php
    require_once("../0_service/printAndRedirect.php");
    require_once("../0_service/databaseSessionTemplate.php");
    requireSession();

    Class UserData{
        private $navigator;

        function __construct(){
            $this->navigator = new Navigation();
        }
        
        public function getUserFromDatabase($login, $password){
            $pdo = connectToDatabase();
            $query = "SELECT users.Id, users.Login, users.Privilege, users.Status
                      FROM users 
                      WHERE users.Login = :login";

            if($password){
                $hashedPassword = substr(hash('sha256', $password), 0, 20);
                $query .= " AND users.Password = :password;";
            }

            $query = $pdo->prepare($query);

            if($password){
                $query->execute([
                    ':login' => $login,
                    ':password' => $hashedPassword
                ]);
            }
            else{
                $query->execute([
                    ':login' => $login
                ]);
            }
        
            $foundedUser = $query->fetch(PDO::FETCH_ASSOC);
            return $foundedUser;
        }

        public function getWorkerEmailByUserId($userId){
            $pdo = connectToDatabase();
            
            $query = "SELECT workers.Email
                    FROM workers
                    WHERE workers.userId = :id;";
            $query = $pdo->prepare($query);
            $query->execute([
                ':id' => $userId
            ]);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $email = $result["Email"];

            return $email;
        }

        public function setTempUserInSession($user){
            $_SESSION['tempUser'] = $user;
        }

        public function checkLoggedWorker(){
            if(empty($_SESSION['login'])){
                $this->navigator->redirectToPage("mainStore/index.php");
                return;
            }
            else{
                $user = $this->getUserFromDatabase($_SESSION['login'], "");

                if($user['Status'] == 2){
                    unset($_SESSION['login']);
                    unset($_SESSION['privilege']);
                    $this->navigator->redirectToPage("mainStore/index.php");
                    return;
                }
            }
        }

        public function checkLoggedAdmin(){
            $this->checkLoggedWorker();
            
            if($_SESSION['privilege'] == 'Pracownik'){
                $this->navigator->redirectToPage("admin/loadTemplate_page_products.php");
            }
            return;
        }

        public function checkLoggedUser(){
            if(!isset($_SESSION['login']) || !isset($_SESSION['privilege'])){
                $this->navigator->redirectToPage("mainStore/page_login.php");
                return;
            }
            else if($_SESSION['privilege'] == "Pracownik"){
                $this->navigator->redirectToPage("admin/loadTemplate_page_products.php");
            }else if($_SESSION['privilege'] == "Administrator"){
                $this->navigator->redirectToPage("admin/loadTemplate_page_workers.php");
            }
        }

        public function getUsername(){
            return $_SESSION['login'];
        }
        public function getUserPrivilege(){
            return $SESSION_['privilege'];
        }
    }

    function checkedLogged($user){
        $serviceUserData = new UserData();
        
        if($user == 'admin'){
            $serviceUserData->checkLoggedAdmin();
        }
        else if($user == 'work'){
            $serviceUserData->checkLoggedWorker();
        }
    }
?> 