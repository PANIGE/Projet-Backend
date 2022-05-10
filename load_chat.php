<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/sql.php");
    $load_chat = $pdo->query('SELECT * FROM messages WHERE id>=(SELECT max(id) FROM messages)-10;');
    while($messages = $load_chat->fetch()){

        $user = GetUserData($messages["UID"]);
        $id = $messages["UID"];
        ?>
        <div class="channel-message-tab">
            <a href="/users/<?= $id?>"><img class="channel-message-avatar" src="/avatars/<?= $id?>"></a>
            
            <div class="channel-message-box"> <h4><?= $user["username"] ?></h4> <?= $messages['message'];?></div>
        </div>
        <?php
    }
?>

