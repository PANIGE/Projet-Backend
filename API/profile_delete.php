<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
    $pdo = GetPDO();
    $id = $_GET["id"]; //ID DU MESSAGE
    $query = $pdo->prepare("DELETE FROM users WHERE ID = :id");
    $query->execute([
    ":id"=>$id
    ]);
}
else {
    http_response_code(405);
}
?>  