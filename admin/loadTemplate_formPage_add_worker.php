<?php
    require_once("../0_service/userData.php");
    checkedLogged('admin');
    
    require_once("../0_service/databaseSessionTemplate.php");

    $template = setTemplate('../admin/templates/formPage_add_worker.twig');
    echo $template->render([]);
?>