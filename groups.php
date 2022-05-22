<?php
    require_once("./php/htmlHelper.php");
    require_once("./php/generalHelper.php");
    require_once("./php/sql.php");
    $pdo = getpdo();
    RequireLogin();
    $ID = $_GET["id"];
    $Group = GetGroupData($ID);
    GenerateHeader("../../banners/groups/".$ID, "Group Profil", 200);

    $self = GetID();

    $selectuser = $pdo->prepare("SELECT UID, pending, rank FROM user_groups WHERE GID = :id ");
    $selectuser->execute([
        ":id"   => $ID,
    ]);
    $users = $selectuser->fetchAll(PDO::FETCH_ASSOC);

    $select_rank = $pdo->prepare("SELECT rank, pending FROM user_groups WHERE UID = :id AND GID = :gid");
    $select_rank->execute([
        ":id" => $self,
        ":gid" => $ID,
    ]);
    $rank = $select_rank->fetch(PDO::FETCH_ASSOC);

    $userInGroup = false;
    $pending = false;
    $nb_users = 0;
    foreach($users as $value){
        if(array_key_exists('UID', $value) && $value["UID"] == $self)
        {
            $userInGroup = true;
            $pending = $value["pending"] == 1;
        }
        if(array_key_exists('UID', $value)&& $value["UID"] == true && $value["pending"] != 1){
            $nb_users += 1;
        }
    }


    $req =$pdo->prepare("SELECT name, is_private FROM groups WHERE id = :id");
    $req->execute([
        ":id" => $ID,
    ]);

    $group = $req->fetch(PDO::FETCH_ASSOC);

    $id_asker = $pdo->prepare("SELECT UID FROM user_groups WHERE GID = :gid AND pending = 1");
    $id_asker->execute([
        ":gid" => $ID,
    ]);
    $ID_asker = $id_asker->fetchAll(PDO::FETCH_ASSOC);
    
    $asker = $pdo->prepare("SELECT username, id FROM users WHERE id IN (SELECT UID FROM user_groups WHERE GID = :gid AND pending = 1)");
    $asker->execute([
        ":gid" => $ID,
    ]);
    $name_asker = $asker->fetchAll(PDO::FETCH_ASSOC);

    $group_users = $pdo->prepare("SELECT username, id FROM users WHERE id IN (SELECT UID FROM user_groups WHERE GID = :gid)");
    $group_users->execute([
        ":gid" => $ID,
    ]);
    $group_membre = $group_users->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        header('location:/group_post');
    }

    $req = $pdo->prepare("SELECT * FROM ultraverse.posts WHERE GID = :GID order by unix DESC LIMIT 50;");
    $req->execute([
        ':GID' => $ID,
    ]);
    $data = $req->fetchAll();
    ?>

<div class="ui container">
    <div class="profile-bg" style="background-image: url('/banners/-1');">
        <div class="overlay"></div>
        <div class="profile">
            <div class="profile-data">
                <div class="cat">
                <div class="rank">

            </div>
            
                <div class="stats">
                <a id="interact-group" onclick="ManageGroup('name', <?= $self ?>)" >
                    <h1 class="username"><?= $group["name"]; ?> </h1>
                </a>
                    <h1 style="margin: 0;color: #5f5;text-shadow: 0 0 6px black;">Nombre de Participant (<?= $nb_users ?>)</h1>
                    <?php if ($userInGroup && $rank["pending"] == 0){ ?>
                        <form id="group-form" class="ui form" method="post" action="/groups.php">
                    </form>
                    <button tabindex="3" class="ui primary button" type="submit" form="group-form">
                    Make a post
                </button>
                <?php } ?>
                
                </div>

                </div>
            </div>
            
            <?php if ($self) echo "<a href=\"/settings/avatar\""?>
            <div class="p-avatar">
                <img height="256" alt="avatar" src="/avatars/-1">
            </div>
            <?php if ($self) echo "</a>"?>
        </div>
    </div>
    
    <div class="profile-segment">

        <div class="left-panel">
        <?php foreach ($data as $post) { ?>
                    <a href="/posts/<?= $post["id"] ?>" style="color:white;" >
                        <div class="ui raised segment" style="margin: 0 0 0.5em 0;">
                            <h2><?= ParseEmotes($post["title"]); ?> <span style="float: right;color: #ffffff85;"><?= GetRelativeTime($post["unix"]); ?></span> </h2><div class="ui divider"></div><p> <?= ParseEmotes($post["message"]) ?> </p>                 <div style="text-align: center;background: var(--background-hue);border-radius: .5em;">
                            <img style="max-height:50em" src="/postsStorage/<?= $post["id"] ?>.png">
                            </div>
                        </div>
                    </a>
                <?php } ?>
        </div>

        <div class="right-panel">
            <div class="ui raised segment">
            <?php if (IsLog()) { ?>
                
                    
                <?php if (!$userInGroup) { 
                    if (!$group["is_private"]) {?>
                    <a id="interact-group" onclick="ManageGroup('join', 0)" >
                        <div class="tab hoverable">
                            <div class="label" style="box-shadow: 0 0 5px 1px #2558ff;background: #2558ff;position: relative;">
                                <h3><i class="circular icon sign in icon"></i>Join Group</time></h3>
                            </div>
                        </div>
                    </a>
                <?php } else {?>
                    <a id="interact-group" onclick="ManageGroup('join', 0)">
                        <div class="tab hoverable">
                            <div class="label" style="box-shadow: 0 0 5px 1px #2558ff;background: #2558ff;position: relative;">
                                <h3><i class="circular icon sign in icon"></i>Ask to join</time></h3>
                            </div>
                        </div>
                    </a>
                <?php } } else { 
                    if ($pending) {?>
                    <a id="interact-group" onclick="ManageGroup('left', 0)">
                        <div class="tab hoverable">
                            <div class="label" style="box-shadow: 0 0 5px 1px #2558ff;background: #2558ff;position: relative;">
                                <h3><i class="circular icon sign in icon"></i>Cancel Request</time></h3>
                            </div>
                        </div>
                    </a>
                    <?php } else { ?>
                        <a id="interact-group" onclick="ManageGroup('left', 0)">
                        <div class="tab hoverable">
                            <div class="label" style="box-shadow: 0 0 5px 1px #2558ff;background: #2558ff;position: relative;">
                                <h3><i class="circular icon sign in icon"></i>Quit Group</time></h3>
                            </div>
                        </div>
                    </a>
                <?php } }                 
                if($group["is_private"] && $name_asker){
                if ($rank["rank"] == 1){
                    foreach ($name_asker as $ask){
                        $id_asker = $ask['id'];
                        print($ask["username"]);?>
                        <a id="interact-group" onclick="ManageGroup('Accept', <?= $id_asker ?>)" >
                        <div class="tab hoverable">
                            <div class="label" style="box-shadow: 0 0 5px 1px #2558ff;background: #2558ff;position: relative;">
                                <h3><i class="circular icon sign in icon"></i>Accept</time></h3>
                            </div>
                        </div>
                        <a id="interact-group" onclick="ManageGroup('Reject', <?= $id_asker ?>)" >
                        <div class="tab hoverable">
                            <div class="label" style="box-shadow: 0 0 5px 1px #2558ff;background: #2558ff;position: relative;">
                                <h3><i class="circular icon sign in icon"></i>Reject</time></h3>
                            </div>
                        </div>
                    </a>

                    <?php    print("<br>");

                    }
                 }
                }
                if($rank){
                if($rank["rank"] == 1){
                    foreach ($group_membre as $value){
                        $select_rank = $pdo->prepare("SELECT rank, pending FROM user_groups WHERE UID = :UID");
                        $select_rank->execute([
                            ":UID" => $value["id"],
                        ]);
                        $group_rank = $select_rank->fetch(PDO::FETCH_ASSOC);
                        if($value['id'] != $self && $group_rank['pending'] != 1){
                        print($value['username']);
                        if($group_rank["rank"] != 1){?>
                        <a id="interact-group" onclick="ManageGroup('Kick', <?= $value['id'] ?>)" >
                        <div class="tab hoverable">
                            <div class="label" style="box-shadow: 0 0 5px 1px #2558ff;background: #2558ff;position: relative;">
                                <h3><i class="circular icon sign in icon"></i>Kick</time></h3>
                            </div>
                        </div>
                        <a id="interact-group" onclick="ManageGroup('Admin', <?= $value['id'] ?>)" >
                        <div class="tab hoverable">
                            <div class="label" style="box-shadow: 0 0 5px 1px #2558ff;background: #2558ff;position: relative;">
                                <h3><i class="circular icon sign in icon"></i>Admin</time></h3>
                            </div>
                        </div>
                    </a>

                    <?php 
                    }print("<br>");
                }}}}
                        ?>
            </div>
        </div>

        <script>

        function ManageGroup(type, id) {
            if (type == "left" && window.confirm("Are you sure you want to quit the group ?")) {
                $.post("/api/group-manage?type="+type+"&group=<?= $ID ?>&id="+id+"")
                location.reload();
            }
            else if (type == "name"){
                $.post("/api/group-manage?type="+type+"&group=<?= $ID ?>&id="+id+"")
                location.reload();
            }
            else if (type != "left") {
                $.post("/api/group-manage?type="+type+"&group=<?= $ID ?>&id="+id+"")
                location.reload();
            }
            
        };

    </script>   

<?php } GenerateFooter(); ?>