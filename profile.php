<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/generalHelper.php");
    require_once("./php/sql.php");
    $pdo = getpdo();
    

    $ID = $_GET["id"];
    $User = GetUserData($ID);
    if (!$User) {
        http_response_code(404);
        echo render_php('404.php');
        die();
    }
    GenerateHeader("../../banners/".$ID, "User Profile", 200);

    $r = $pdo->prepare("SELECT icon, title FROM ultraverse.badges WHERE ID in (SELECT  BID from user_badge where UID = :id);");
    $r->execute([
        ":id" => $User["id"]
    ]);
    $badges = $r->fetchAll(PDO::FETCH_ASSOC);

    $self = $ID == GetID();


    $req = $pdo->prepare("SELECT * FROM ultraverse.posts where UID = :uid order by unix DESC LIMIT 50;");
    $req->execute([
        ":uid" => $ID
    ]);
    $data = $req->fetchAll();

?>

<div class="ui container">
    <div class="profile-bg" style="background-image: url('/banners/<?= $ID ?>');">
        <div class="overlay"></div>
        <div class="profile">
            <div class="profile-data">
                <div class="cat">
                <div class="rank">
            
                    
                    
                </div>
                <div class="stats">
                    <h1 class="username"><?= $User["username"] ?></h1>
                    
                    <?php switch($User["rank"]): 

                        case 1: ?>
                            <h1 style="margin: 0;color: #5f5;text-shadow: 0 0 6px black;">Ultraverse Member</h1>
                        <?php break; ?>

                        <?php case 2: ?>
                            <h1 style="margin: 0;color: #99f;text-shadow: 0 0 6px black;">Ultraverse Moderator</h1>
                        <?php break; ?>

                        <?php case 3: ?>
                            <h1 style="margin: 0;color: #f55;text-shadow: 0 0 6px black;">Ultraverse Administrator</h1>
                        <?php break; ?>

                    <?php endswitch; ?>

                    <h3 style="margin: 0;color: #fff;text-shadow: 0 0 6px black;"> <?= GetUserFollowers($ID) ?> Followers</h1>
                </div>
                </div>
            </div>
            
            <?php if ($self) echo "<a href=\"/settings/avatar\""?>
            <div class="p-avatar">
                <img height="256" alt="avatar" src="/avatars/<?= $ID ?>">
            </div>
            <?php if ($self) echo "</a>"?>
        </div>
    </div>
    
    <div class="profile-segment">

        <div class="left-panel">
            <?php foreach ($data as $post) { ?>
                <a href="/posts/<?= $post["id"] ?>" style="color:white;" >
                    <div class="ui raised segment" style="margin: 0 0 0.5em 0;">
                        <h2><?= $post["title"]; ?> <span style="float: right;color: #ffffff85;"><?= GetRelativeTime($post["unix"]); ?></span> </h2><div class="ui divider"></div><p> <?= $post["message"] ?> </p>                 <div style="text-align: center;background: var(--background-hue);border-radius: .5em;">
                           <img style="max-height:50em" src="/postsStorage/<?= $post["id"] ?>.png">
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
    
        
        <div class="right-panel">
            <div class="ui raised segment">
                
                <div class="tab">
                    <div class="label" style="box-shadow: 0 0 5px 1px #2558ff;background: #2558ff;position: relative;">
                        <h3><i class="circular icon sign in icon"></i><time class="timeago" datetime="<?= date(DATE_RFC3339, $User["register"]); ?>)" title="<?= date('c', $User["register"]); ?>"> <?= GetRelativeTime($User["register"])?></time></h3>
                    </div>
                </div>
                <div class="tab">
                    <div class="label" style="box-shadow: 0 0 5px 1px #47ffe8;background: #47ffe8;position: relative;">
                        <h3><i class="circular icon power icon"></i><time class="timeago" datetime="<?= date(DATE_RFC3339, $User["last_seen"]); ?>)" title="<?= date('c', $User["last_seen"]); ?>"> <?= GetRelativeTime($User["last_seen"], true)?></h3>
                    </div>
                </div>

                <?php if (!$self) { ?>
                <a id="add-friend-button" href="#"><div class="tab hoverable">
                            <div class="label" friend="-1" id="friend-label" style="border: 2px solid;box-shadow: 0 0 4px 0px; position:relative; color: #494949;">
                                <h3 id="friend-text"><i class="circular plus icon"></i>Loading</h3>
                            </div>
                                <i class="right chevron icon"></i>
                            </div>
                        </a>
                    <?php } ?>

                <?php if (!$self) { ?>
                <a id="add-chat-button" onclick=""><div class="tab hoverable">
                            <div class="label" id="chat-label" style="border: 2px solid;box-shadow: 0 0 4px 0px; position:relative; color: #494949;">
                                <h3 id="chat-text"><i class="circular plus icon"></i>chat</h3>
                            </div>
                                <i class="right chevron icon"></i>
                            </div>
                        </a>
                    <?php } ?>

                <div class="ui divider"></div>
                
                <?php foreach($badges as $badge){ ?>
                <div class="tab">
                    <div class="label" style="box-shadow: 0 0 5px 1px #72ddff;background: #72ddff;position: relative;">
                        <h3><i class="<?= $badge["icon"] ?>"></i><?= $badge["title"] ?></h3>
                    </div>
                </div>
                <?php } ?>
                
                
            </div>
        </div>
    </div>
             
    <script>
        function UpdateFriend() {
            $.get("/api/friend?id=<?= $ID ?>", (d, s) => {
            $d = $.parseJSON(d);
            switch ($d.status) {
                case 0:
                    $("#friend-label").css("color", "#00ffee");
                    $("#friend-text").html("<i class=\"circular plus icon\"></i>Follow");
                    $("#friend-label").attr("friend", "0");
                    break;
                case 1:
                    $("#friend-label").css("color", "rgb(49 255 0)");
                    $("#friend-text").html("<i class=\"circular user icon\"></i>Following");
                    $("#friend-label").attr("friend", "1");
                    break;
                case 2:
                    $("#friend-label").css("color", "rgb(251 255 19)");
                    $("#friend-text").html("<i class=\"circular user icon\"></i>Mutual");
                    $("#friend-label").attr("friend", "2");
                    break;
            }
        });
        }

        $("#add-friend-button").click(()=> {
            $current = parseInt($("#friend-label").attr("friend"));
            console.log($current);
            switch ($current) {
                case 0:
                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '/api/setfriend?id=<?= $ID ?>&fr=1',
                        success: function(data) {
                            //callback
                        }
                    });
                    break;
                case 1:
                case 2:
                    $.ajax({
                        async: false,
                        type: 'GET',
                        url: '/api/setfriend?id=<?= $ID ?>&fr=0',
                        success: function(data) {
                            //callback
                        }
                    });
                    break;
            }

            UpdateFriend();
        });

        UpdateFriend();
    </script>   
    

<?php GenerateFooter(); ?>