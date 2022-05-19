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
    <input type="text" name="title" placeholder="title"><br/>
    <div class="ui divider"></div>
    <input id="descrip" onkeyup="conteur()" type="text" placeholder="description" maxlength="240">
    <span id="conteur" style="position:absolute; right:0; width:20px ;height:20px;"></span>

    <div class="ui divider"></div>
    <textarea id="content" name="htmlcontent" placeholder="article" columns="100" rows="20" onkeyup="updatehtml()"></textarea>
    <div class="ui divider"></div>
    
    <button style="float:right" type="submit" class="ui blue huge inverted button">publish</button>
</form>

<div id="preview"></div>

<script>
    function updatehtml() {
        $('#preview').html($("#content").val());
    }
    function conteur(){  
        const input        = document.getElementById('descrip');
        const maxlength    = parseInt(input.getAttribute("maxlength"));
        const conteur      = document.getElementById('conteur');
        const len          = input.value.length;
        const difference   = maxlength - len; 
        conteur.innerHTML  = difference;
        };


</script>