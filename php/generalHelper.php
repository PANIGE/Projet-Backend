<?php
require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
     $pdo = GetPDO();

function IsLog() {
    return GetID() != -1;
}

function RequireLogin() {
    if (!IsLog()) {
        http_response_code(302);
        header("location:/login?redir=".$_SERVER['REQUEST_URI']."&ew=You%20must%20login%20to%20continue");
        die();
    }
}

function GetID() {
    $pdo = getPDO();

    if (!isset($_COOKIE["Authorisation"])) return -1;
    $req = $pdo->prepare("SELECT UID FROM webtokens WHERE token = :tok");
    $req->execute([
        ":tok" => $_COOKIE["Authorisation"]
    ]);
    $t = $req->fetchAll(PDO::FETCH_ASSOC);
    if ($req->rowCount() == 0) return -1;
    return $t[0]["UID"];
}

function Context() {
    $data = [
        "Log" => IsLog(),
        "ID" => GetID(),
    ];
    if (IsLog()) {
        $data["User"] = GetUserData($data["ID"]);
    }
    return $data;
}

function GetSafeUsername($username) {
    $temp = str_replace(" ", "_", trim($username));
    return strtolower($temp);
}

function GetIDFromUsername($username) {
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
     $pdo = GetPDO();
    
    $req = $pdo->prepare("SELECT ID FROM users WHERE username_safe = :usr");
    $req->execute([
        ":usr" => GetSafeUsername($username)
    ]);
    $t = $req->fetchAll(PDO::FETCH_ASSOC);
    if ($req->rowCount() == 0) return -1;
    return $t[0]["ID"];
}

function GetUserData($id) {
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
     $pdo = GetPDO();

    $req = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $req->execute([
        ":id" => $id
    ]);
    $data = $req->fetch(PDO::FETCH_ASSOC);
    $data["online"] = (time() - $data["last_seen"]) < 60;
    return $data;
}

function UpdateLastSeen() {
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
     $pdo = GetPDO();
    if (IsLog()) {
        $r = $pdo->prepare("UPDATE `users` SET `last_seen` = :time WHERE (`id` = :id);");
        $r->execute([
           ":time" => time(),
           "id" => GetID()
        ]);
      }
}

function GetRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * https://stackoverflow.com/questions/2690504/php-producing-relative-date-time-from-timestamps
 */
function GetRelativeTime($date, $isConnection=false)
{
    $now = time();
    $diff = $now - $date;

    if ($diff < 60){
        if ($isConnection) {
            return "Connected";
        }
        return sprintf($diff > 1 ? '%s seconds ago' : 'a second ago', $diff);
    }

    $diff = floor($diff/60);

    if ($diff < 60){
        return sprintf($diff > 1 ? '%s minutes ago' : 'one minute ago', $diff);
    }

    $diff = floor($diff/60);

    if ($diff < 24){
        return sprintf($diff > 1 ? '%s hours ago' : 'an hour ago', $diff);
    }

    $diff = floor($diff/24);

    if ($diff < 7){
        return sprintf($diff > 1 ? '%s days ago' : 'yesterday', $diff);
    }

    if ($diff < 30)
    {
        $diff = floor($diff / 7);

        return sprintf($diff > 1 ? '%s weeks ago' : 'one week ago', $diff);
    }

    $diff = floor($diff/30);

    if ($diff < 12){
        return sprintf($diff > 1 ? '%s months ago' : 'last month', $diff);
    }

    $diff = date('Y', $now) - date('Y', $date);

    return sprintf($diff > 1 ? '%s years ago' : 'last year', $diff);
}


function IsImage( $url ){
    $pos = strrpos( $url, ".");
      if ($pos === false)
        return false;
      $ext = strtolower(trim(substr( $url, $pos)));
      $imgExts = array(".gif", ".jpg", ".jpeg", ".png", ".tiff", ".tif");
      if ( in_array($ext, $imgExts) )
        return true;
  return false;
  }
  
  function GetGroupData($id) {
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
     $pdo = GetPDO();

    $req = $pdo->prepare("SELECT * FROM groups WHERE id = :id");
    $req->execute([
        ":id" => $id
    ]);
    $data = $req->fetch(PDO::FETCH_ASSOC);
}
