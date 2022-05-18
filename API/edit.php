<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
    $pdo = GetPDO();
    $id = $_GET["id"];
    $message = $_GET["msg"];
    $query = $pdo->prepare("UPDATE `messages` SET `message` = :message WHERE ID = :id");
    $query->execute([
    ":id"=>$id,
    ":message"=>$message,
    ]);
}
else {
    http_response_code(405);
}
?>  