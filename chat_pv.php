<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/sql.php");
    RequireLogin();
    GenerateHeader("register.jpg", "Chat", 150);
    $pdo = GetPDO();
    $ID = GetID();

    //PUBLIC CHANNELS


    $Friend_user=$pdo->prepare('SELECT `to`FROM `relations` WHERE `fro` =:id');
    $Friend_user->execute([
        ":id" => $ID
    ]);
    $data= $Friend_user->fetchAll(PDO::FETCH_ASSOC);
    $friend = $_GET["id"];


    foreach ($data as $t) { ?>
        <div class="ui segment">
            <a class="ui blue inverted button" href="/chat/<?=$t["to"]?>"> Contact</a> <img style="height:3em;margin-bottom:-1em" src="/avatars/<?= $t["to"] ?>"> <span style="font-style:25px"><?= GetUserData($t["to"])["username"] ?></span>
        </div>
    <?php } ?>

<?php GenerateFooter(); ?>