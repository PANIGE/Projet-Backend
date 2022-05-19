<?php
$folder = $_GET["fold"];
$id = "-1.png";
if (isset($_GET["id"]) && file_exists("./".$folder."/".$_GET["id"].".png")) {
    $id = $_GET["id"].".png";
}
$content = file_get_contents('./'.$folder.'/'.$id);
header('Content-Type: Image/PNG');
echo $content;