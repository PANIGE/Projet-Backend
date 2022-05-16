<?php 
//Input : $_GET["ID"]
//Needed vars : getID()
/*
Première étape: vérifier si nous on suis l'autre (sql req) (.rowCount() > 0)
Si oui :
  Si l'autre nous suis (sql req)
      Si oui :
            retourner 2
        si non :
            retourner 1
si non:
    retourner 0

expected result : {
    "status" : (0 = nope, 1 = one way, 2 = mutual)    
}*/
//sid = GetID();
//oid = $_GET id
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
    $pdo = GetPDO();
    require_once($_SERVER['DOCUMENT_ROOT']."/php/generalHelper.php");
    RequireLogin();

    if (!isset($_GET["id"])) {
        http_response_code(400);
        die();
    }
    $OID = $_GET["id"];
    $SID = GetID();
    $query=$pdo->prepare('SELECT `fro`, `to` FROM relations WHERE fro = :sid AND `to` = :oid');
    $query->execute([
        ":sid" => $SID,
        ":oid" => $OID,
    ]);
    $t = $query->fetchAll(PDO::FETCH_ASSOC);
    $Bool = $query->rowCount() > 0; 
    if ($Bool){
        $Requete=$pdo->prepare('SELECT `to`, `fro` FROM relations WHERE `to` = :sid AND fro = :oid');
        $Requete->execute([
            ":sid" => $SID,
            ":oid" => $OID,
        ]);
        $d = $Requete->fetchAll(PDO::FETCH_ASSOC);
        $Dude = $Requete->rowCount() > 0;
            if ($Dude){
                echo json_encode([
                    "status" => 2
                ]);
            }
            else{
                echo json_encode([
                    "status" => 1
                ]);;
            }
        }
    else {
        echo json_encode([
            "status" => 0
        ]);;
    }

?>