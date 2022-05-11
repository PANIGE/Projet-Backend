<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/sql.php");
    $load_chat = $pdo->query('SELECT * FROM messages WHERE id>=(SELECT max(id) FROM messages)-30;');
    while($message = $load_chat->fetch()){

        $user = GetUserData($message["UID"]);
        $id = $message["UID"];
        $images = [];
        $pattern = "(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})";
        if (preg_match($pattern, $message["message"], $matches)) {
            foreach ($matches as $ma) {
                if (IsImage($ma)) {
                    array_push($images, $ma);
                }
                $message['message'] = str_replace($ma, "<a href=\"".$ma."\">".$ma."</a>", $message['message']);
                
            }

        }

        ?>
        <div class="channel-message-tab">
            <a href="/users/<?= $id?>"><img class="channel-message-avatar" src="/avatars/<?= $id?>"></a>
            
            <div class="channel-message-box"> <a href="/users/<?= $id?>"><h4>
                
                <?php
                if ($user["online"]) echo "<i class=\"green circle small icon\"></i>";
                else echo "<i class=\"grey circle small icon\"></i>";

                
            ?>
            
            <?= $user["username"] ?>
            <?php 
                switch ($user["rank"]) {
                    case 2:
                        echo "<span class=\"ui small blue horizontal label\" style=\"color: white!important;\">Moderator</span>";
                    break;
                    case 3:
                        echo "<span class=\"ui small red horizontal label\" style=\"color: white!important;\">Admin</span>";
                    break;  
                }
            ?>    
        </h4></a> <?=htmlspecialchars_decode($message['message']);?><?php 
        foreach ($images as $im) {
            echo "<img style=\"height: 32em;width: fit-content;\" src=\"".$im."\" />";
        }
        ?>
        
        </div>
        </div>
        <?php
    }
?>

