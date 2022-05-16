<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
    $pdo = GetPDO();
    require_once($_SERVER['DOCUMENT_ROOT']."/php/generalHelper.php");
    RequireLogin();

    $id = GetID();
    $req = $pdo->prepare("UPDATE `ultraverse`.`users` SET `enabled` = '0' WHERE (`id` = :id);");
    $req->execute([":id" => $id]);
}