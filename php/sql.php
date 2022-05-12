<?php 
$_pdo = null;

function getPDO() {
    global $_pdo;
    if($_pdo == null) {
        $Host = "127.0.0.1";
        $Name = "ultraverse";
        $PW   = "MetaverseIsShit";
    
        $_pdo = new PDO('mysql:host='.$Host.';dbname='.$Name.';charset=utf8', $Name , "MetaverseIsShit" );
        //echo "hello";    
    }
    return $_pdo;
}