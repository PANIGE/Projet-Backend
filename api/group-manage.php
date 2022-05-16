<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
    $pdo = GetPDO();
    require_once($_SERVER['DOCUMENT_ROOT']."/php/generalHelper.php");

    $type = $_GET["type"];
    $GID = $_GET["id"];
    $SID=GetID();

    if ($type == "join") {
        $priv = $pdo->prepare("SELECT is_private FROM groups WHERE id = :id");
        $priv->execute([
            ":id" => $GID,
        ]);
        $private = $priv->fetch();
        if ($private){

        }
        else{
            $join = $pdo->prepare("INSERT INTO user_groups (UID, GID, rank) value (:UID, :GID, 0)");
            $join->execute([
                ":UID" => $SID,
                ":GID" => $GID,
            ]);
            $join_group = $join->fetchAll();
        }
    }
    if($type == "left"){
        $left = $pdo->prepare("DELETE FROM user_groups WHERE GID = :GID AND UID = :UID");
        $left->execute([
            ":GID" => $GID,
            ":UID" => $SID,
        ]);
        $left_group = $left->fetchAll();
    }
}