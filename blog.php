<?php
//TOUT LES TITRES
require_once("./php/htmlHelper.php");
require_once("./php/sql.php");
$pdo = GetPDO();
GenerateHeader("register.jpg", "blog",260);
$query=$pdo->prepare('SELECT id,name,description FROM blog ORDER BY id DESC');
$query->execute();
$data = $query->fetchALL(PDO::FETCH_ASSOC);

?>
<div>
    <?php foreach($data as $blog)?>
        <h2><?=blog["name"]?></h2>
        <h3><?=blog["descrition"]?></h3>
    <a href="blog_r.php?id=<?=$blog["id"]?>">read more</a>
</div>
<?php GenerateFooter(); ?>

