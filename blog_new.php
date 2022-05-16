<?php
//le FORM a faire pour creer un article
//qui va le rentrer dans la DB
require_once("./php/htmlHelper.php");
require_once("./php/sql.php");
$pdo = GetPDO();
GenerateHeader("homepage.jpg", "blog");
if(isset($_POST['title'],$_POST['htmlcontent'])){
    if(!empty($_POST['title']) && !empty($_POST['htmlcontent'])) {

    }else {
        http_response_code(400);
        header("location:/blog_new");
    }
}
?>

<form class="ui form">
    <input type="text" name="title"><br/>
    <textarea id="content" name="htmlcontent" columns="100" rows="20" onkeyup="updatehtml()"></textarea>
</form>
<div class="ui divider"></div>
<div id="preview"></div>

<script>
    function updatehtml() {
        $('#preview').html($("#content").val());
    }
    
</script>