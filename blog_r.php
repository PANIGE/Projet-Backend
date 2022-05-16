<?php
// affichage de l'article
//$id = $_GET["id"] // ID DU TRUC
//Tu affiche un article a l'aide du $id
//
//Header
//  html de l'article
//footer du site
require_once("./php/htmlHelper.php");
require_once("./php/sql.php");
GenerateHeader("homepage.jpg", "blog");
$pdo = GetPDO();
$ID=$_GET[id];
if (!isset($ID) || !is_numeric($ID) ) {
    http_response_code(404);
    header('location:/index?er=This%20post%20does%not%exist');
}
else{
    $query=$pdo->prepare('SELECT `name`,`htmlcontent` where id=:id');
    $query->execure([
        ':id' =>$ID
    ]);
    $data = $query->fetch(PDO::FETCH_ASSOC);
    echo $data["htmlcontent"];
}

GenerateFooter(); ?>