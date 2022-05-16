<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/sql.php");
    RequireLogin();
    GenerateHeader("register.jpg", "Chat", 150);
    $pdo = GetPDO();
    $ID = GetID();

    //PUBLIC CHANNELS
    echo "<h3 class=\"ui horizontal header divider\">Public chat</h3>";
    $req = $pdo->query('SELECT name FROM ultraverse.channels;');
    $publicChannels = $req->fetchAll();

    foreach ($publicChannels as $chan) {?>
        <div class="ui segment">
            <a class="ui blue inverted button" href="/chat/<?= urlencode($chan["name"])?>">Join</a> <i class="ui large circular hashtag icon"></i> <span style="font-size: 25px;position: absolute;top: 22px;"><?=$chan["name"]?></span>
        </div>


    <?php }

    $Friend_user=$pdo->prepare('SELECT `to`FROM `relations` WHERE `fro` =:id');
    $Friend_user->execute([
        ":id" => $ID
    ]);
    $data= $Friend_user->fetchAll(PDO::FETCH_ASSOC);

    echo "<h3 class=\"ui horizontal header divider\">Private chat</h3>";

    foreach ($data as $t) { 
        if (GetUserData($t["to"])["enabled"] != 1) {
            continue;
        }?>
        <div class="ui segment">
            <a class="ui blue inverted button" href="/chat/<?=$t["to"]?>">Contact</a> 
            <img style="height:3em;margin-bottom:-1em;margin-right: 0.5em;border-radius: 500rem;" src="/avatars/<?= $t["to"] ?>"> 
            <span style="font-size: 25px;position: absolute;top: 25px;"><?= GetUserData($t["to"])["username"] ?></span>
        </div>
    <?php } ?>

<?php GenerateFooter(); ?>