<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/php/htmlHelper.php");
    $id = GetID();
    $private=$pdo->prepare('SELECT private FROM users WHERE ID = :id ');
    $private->execute([
        ":id"=> $id ,
    ]);
    $private = $private->fetch(PDO::FETCH_ASSOC)["private"];
    if($private == 0){
        $New = $pdo->prepare("UPDATE `users` SET `private` = :public WHERE ID = :id");
        $New->execute([
        ":public"=>1,
        ":id"=>$id,
        ]);
    }else{
        $New = $pdo->prepare("UPDATE `users` SET `private` = :public WHERE ID = :id");
        $New->execute([
        ":public"=>0,
        ":id"=>$id,
        ]);
    }
}
else {
    http_response_code(405);
}
?>  