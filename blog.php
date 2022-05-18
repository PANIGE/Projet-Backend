<?php
//TOUT LES TITRES
require_once("./php/htmlHelper.php");
require_once("./php/sql.php");
$pdo = GetPDO();
GenerateHeader("register.jpg", "blog",260);
$query=$pdo->prepare('SELECT id,name,description FROM blog ORDER BY id DESC');
$query->execute();
$data = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<div>
    <?php foreach($data as $blog) {?>
        <div class="ui segment">
            <h2><?=$blog["name"]?></h2>
            <h3><?=$blog["description"]?></h3>
            <a href="blog/<?=$blog["id"]?>">read more</a>
    </div>
    <?php } ?>
</div>
<?php GenerateFooter(); ?>

