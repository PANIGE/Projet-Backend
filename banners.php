<?php
$id = "-1.png";
if (isset($_GET["id"]) && file_exists("./banners/".$_GET["id"].".png")) {
    $id = $_GET["id"].".png";
}
$content = file_get_contents('./banners/'.$id);
header('Content-Type: Image/PNG');
echo $content;