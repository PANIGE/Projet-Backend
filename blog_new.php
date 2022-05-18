<?php
//le FORM a faire pour creer un article
//qui va le rentrer dans la DB
require_once("./php/htmlHelper.php");
require_once("./php/sql.php");
$pdo = GetPDO();
GenerateHeader("homepage.jpg", "blog");
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST['title']) && !empty($_POST['htmlcontent'])) {
        $title=htmlspecialchars($_POST['title']);
        $content=htmlspecialchars($_POST['htmlcontent']);
        $query=$pdo->prepare('INSERT INTO blog (name , htmlcontent, description) VALUE (:title , :content, :description)');
        $query->execute([
            ":title"  =>$title,
            "content" =>$content,
        ]);
        die();
    }else {
        die();
        http_response_code(400);
        header("location:/blog_new");
    }
}
?>

<form class="ui form" action="/blog_new" method="post">
    <input type="text" name="title"><br/>
    <textarea id="content" name="htmlcontent" columns="100" rows="20" onkeyup="updatehtml()"></textarea>
    <input type="submit" value="publish"/>
</form>
<div class="ui divider"></div>
<div id="preview"></div>

<script>
    function updatehtml() {
        $('#preview').html($("#content").val());
    }
    
</script>