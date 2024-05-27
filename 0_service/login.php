<?php
    require_once("../0_service/printAndRedirect.php");
    require_once("../0_service/databaseSessionTemplate.php");

    Class Login{
        public function loginWithoutVerification($user){
            $navigator = new Navigation();
            $_SESSION['login'] = $user['Login'];
            $_SESSION['privilege'] = ($user['Privilege'] == '1') ? "Administrator" : "Pracownik";

            $navigator->redirectToPage("admin/loadTemplate_page_workers.php");
            exit();
        }

        public function logUserOnPage($login, $privilege){
            $userName = $login;

            if($privilege == 2){
                $privilege = "Pracownik";
            }
            else if($privilege  == 1){
                $privilege = "Administrator";
            }

            $_SESSION['login'] = $userName;
            $_SESSION['privilege'] = $privilege;
        }

        public function logout(){
            if($_SESSION['login']){
                unset($_SESSION['login']);
                unset($_SESSION['privilege']);
                
                echo '<script>window.location = "../index.php"</script>';
            }
        }
    }    
?>