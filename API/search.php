<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
    $pdo = GetPDO();
    $searchTerms = "%".$_GET["q"]."%"; // api/search?q=term
    $query = $pdo->prepare('SELECT username, id FROM ultraverse.users where username like :term AND enabled = 1');
    $query ->execute([
        ":term" => $searchTerms
    ]);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result);
    echo ($json);
?>