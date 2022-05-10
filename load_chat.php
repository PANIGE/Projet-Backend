<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/sql.php");
    $load_chat = $pdo->query('SELECT * FROM messages');
    while($messages = $load_chat->fetch()){

        $user = GetUserData($messages["UID"]);
        $id = $messages["UID"];
        ?>
        <div class="channel-message-tab">
            <img class="channel-message-avatar" src="/avatars/<?= $id?>">
            <div class="channel-message-box"> <h4><?= $user["username"] ?></h4> <?= $messages['message'];?></div>
        </div>
        <?php
    }
?>

