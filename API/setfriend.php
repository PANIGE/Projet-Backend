<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
    $pdo = GetPDO();
    require_once($_SERVER['DOCUMENT_ROOT']."/php/generalHelper.php");
    $SID=GetID();
    $OID=$_GET["id"];
    $is_friend=$_GET["fr"];
    if ($is_friend==1){
        $query=$pdo->prepare('SELECT `fro`, `to` FROM `relations` WHERE `fro`=:sid AND `to`=:oid');
        $query->execute([
            "sid" => $SID,
            "oid" => $OID,
        ]);
        $t = $query->fetchAll(PDO::FETCH_ASSOC);
        $Bool = $query->rowCount() > 0; 
        if ($Bool) {
            die();
        }
        else{
            $requete=$pdo->prepare('INSERT INTO relations (`fro`,`to`) VALUE (:sid ,:oid)');
            $requete->execute([
                "sid" =>$SID,
                "oid" =>$OID
            ]);
        }
    }
    elseif ($is_friend==0) {
        $req=$pdo->prepare('DELETE FROM relations WHERE (fro = :sid AND `to` = :oid);');
        $req->execute([
            "sid" => $SID,
            "oid" => $OID
        ]);
    }
    
?>