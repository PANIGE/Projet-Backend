<?php
    require_once("./php/htmlHelper.php");
    require_once("./php/generalHelper.php");
    require_once("./php/sql.php");
    $pdo = getpdo();
    RequireLogin();
    $ID = $_GET["id"];
    $Group = GetGroupData($ID);
    GenerateHeader("../../banners/groups/".$ID, "Users Name", 200);
    $self = GetID(); ?>

<?php  GenerateFooter(); ?>