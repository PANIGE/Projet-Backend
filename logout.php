<?php 
    require_once("./php/generalHelper.php");
    require_once("./php/sql.php");
    if (IsLog()) {
        $token = $_COOKIE['Authorisation'];
        setcookie('Authorisation', '', time() - 3600, '/');
        $r = $pdo->prepare("DELETE FROM webtokens WHERE token = :tok");
        $r->execute([
            ":tok" => $token
        ]);
        http_response_code(302);
        header("location:/?es=You've%20been%20disconnected%20successfully");
    }
    else {
        http_response_code(302);
        header("location:/");
    }
    
