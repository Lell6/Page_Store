<?php
    require_once("../0_service/userData.php");
    checkedLogged('work');

    if(isset($_SESSION['login'])){
        unset($_SESSION['login']);
        unset($_SESSION['privilege']);

        echo '<script>window.location = "../mainStore/index.php"</script>';
    }
?>