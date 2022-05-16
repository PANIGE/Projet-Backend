<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/sql.php");
    $chan = $_GET["chan"];
    if (str_starts_with($chan, "#")) {
        //It's public chat
        $load_chat = $pdo->prepare('SELECT * FROM messages WHERE channel = :chan;');
        $load_chat->execute([
            ":chan" => $chan
        ]);
    }
    elseif (str_starts_with($chan, "~")) {
        //It's a group
    }
    elseif (is_numeric($chan)) {
        //it's a private chat
        $load_chat = $pdo->prepare('SELECT * FROM ultraverse.messages where (UID = :sid OR UID = :oid) AND (channel = :sid OR channel = :oid) ;');
        $load_chat->execute([
            ":sid" => GetID(),
            ":oid" => $chan,
        ]);
    }
    else {
        http_response_code(404);
        die();
    }
    


    while($message = $load_chat->fetch()){
        
        $user = GetUserData($message["UID"]);
        if ($user["enabled"] != 1) {
            continue;
        }
        $id = $message["UID"];
        $self = $id == GetID();
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
        <div class="channel-message-tab" style="position:relative;" id=<?= $message["ID"] ?>>
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
                </h4></a><?=htmlspecialchars_decode($message['message']);?><?php 
                foreach ($images as $im) {
                    echo "<img style=\"height: 32em;width: fit-content;\" src=\"".$im."\" />";
                }
                ?>
                <?php if ($self == $id) {?>
                <a id="delete-icon" class="ui mini red inverted button" style="position:absolute;right: 1em;top: 1em;height: 2.5em;width: 2.5em;" onclick="delete_msg(<?= $message["ID"] ?>)"><i class="trash icon" style="margin-left: -0.7em;"></i></a>
                <a id="change_message" class="ui mini blue inverted button" style="position:absolute;right: 4.7em;top: 1em;" onclick="edit_msg(<?= $message["ID"] ?>)">Edit</a>
                    
                <?php } ?>
            </div>

            
        </div>
        <?php
    }
?>
