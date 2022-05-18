<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/php/generalHelper.php");
    $pdo = GetPDO();

    $type = $_GET["type"];
    $GID = $_GET["group"];
    $SID=GetID();

    if ($type == "join") {
        $priv = $pdo->prepare("SELECT is_private FROM groups WHERE id = :id");
        $priv->execute([
            ":id" => $GID,
        ]);
        $private = $priv->fetch(PDO::FETCH_ASSOC);
        if ($private['is_private']){
            echo "<script>alert();</script>";
            $join = $pdo->prepare("INSERT INTO user_groups (UID, GID, rank, pending) value (:UID, :GID, 0, 1)");
            $join->execute([
                ":UID" => $SID,
                ":GID" => $GID,
            ]);
            $join_group = $join->fetchAll();
        }
        else{
            $join = $pdo->prepare("INSERT INTO user_groups (UID, GID, rank, pending) value (:UID, :GID, 0, 0)");
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