<?php
    require_once("./php/htmlHelper.php");
    require_once("./php/sql.php");
    $ID = $_GET["id"];
    $User = GetUserData($ID);
    $query=$pdo->prepare("INSERT relation (origin) VALUE (:iduser)");
?>