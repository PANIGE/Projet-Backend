<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/php/generalHelper.php");
    $pdo = GetPDO();

    $type = $_GET["type"];
    $GID = $_GET["group"];
    $SID=GetID();
    $UID = $_GET["id"];

    if ($type == "join") {
        $priv = $pdo->prepare("SELECT is_private FROM groups WHERE id = :id");
        $priv->execute([
            ":id" => $GID,
        ]);
        $private = $priv->fetch(PDO::FETCH_ASSOC);
        if ($private['is_private']){
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
    if($type == 'Accept'){
        $accept = $pdo->prepare("UPDATE user_groups SET pending = 0 WHERE UID = :UID AND GID = :GID");
        $accept->execute([
            ':UID' => $UID,
            ':GID' => $GID,
        ]);
    }
    if($type == 'Reject'){
        $accept = $pdo->prepare("DELETE FROM user_groups WHERE UID = :UID AND GID = :GID");
        $accept->execute([
            ':UID' => $UID,
            ':GID' => $GID,
        ]);
    }
}