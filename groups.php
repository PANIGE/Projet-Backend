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

    $selectuser = $pdo->prepare("SELECT UID, COUNT(*) `count`, pending, rank FROM user_groups WHERE GID = :id ");
    $selectuser->execute([
        ":id"   => $ID,
    ]);
    $users = $selectuser->fetchAll(PDO::FETCH_ASSOC);

    $userInGroup = false;
    $pending = false;
    $nb_users = 0;
    foreach($users as $value)
    {
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

    $asker = $pdo->prepare("SELECT username FROM users WHERE id = (SELECT UID FROM user_groups WHERE GID = :id AND pending = 1)");
    $asker->execute([
        ":id" => $ID,
    ]);
    $name_asker = $asker->fetch(PDO::FETCH_ASSOC);
?>

<div class="ui container">
    <div class="profile-bg" style="background-image: url('/banners/groups/<?= $ID ?>');">
        <div class="overlay"></div>
        <div class="profile">
            <div class="profile-data">
                <div class="cat">
                <div class="rank">

            </div>
                <div class="stats">
                    <h1 class="username"><?= $group["name"]; ?> </h1>
                    <h1 style="margin: 0;color: #5f5;text-shadow: 0 0 6px black;">Nombre de Participant (<?= $nb_users ?>)</h1>
                </div>
                </div>
            </div>
            
            <?php if ($self) echo "<a href=\"/settings/avatar\""?>
            <div class="p-avatar">
                <img height="256" alt="avatar" src="/avatars/groups/<?= $ID ?>">
            </div>
            <?php if ($self) echo "</a>"?>
        </div>
    </div>
    
    <div class="profile-segment">

        <div class="left-panel">
            
        </div>
    
        
        <div class="right-panel">
            <div class="ui raised segment">
            <?php if (IsLog()) { ?>
                
                    
                <?php if (!$userInGroup) { 
                    if (!$group["is_private"]) {?>
                    <a id="interact-group" onclick="ManageGroup('join')" >
                        <div class="tab hoverable">
                            <div class="label" style="box-shadow: 0 0 5px 1px #2558ff;background: #2558ff;position: relative;">
                                <h3><i class="circular icon sign in icon"></i>Join Group</time></h3>
                            </div>
                        </div>
                    </a>
                <?php } else {?>
                    <a id="interact-group" onclick="ManageGroup('join')">
                        <div class="tab hoverable">
                            <div class="label" style="box-shadow: 0 0 5px 1px #2558ff;background: #2558ff;position: relative;">
                                <h3><i class="circular icon sign in icon"></i>Ask to join</time></h3>
                            </div>
                        </div>
                    </a>
                <?php } } else { 
                    if ($pending) {?>
                    <a id="interact-group" onclick="ManageGroup('left')">
                        <div class="tab hoverable">
                            <div class="label" style="box-shadow: 0 0 5px 1px #2558ff;background: #2558ff;position: relative;">
                                <h3><i class="circular icon sign in icon"></i>Cancel Request</time></h3>
                            </div>
                        </div>
                    </a>
                    <?php } else { ?>
                        <a id="interact-group" onclick="ManageGroup('left')">
                        <div class="tab hoverable">
                            <div class="label" style="box-shadow: 0 0 5px 1px #2558ff;background: #2558ff;position: relative;">
                                <h3><i class="circular icon sign in icon"></i>Quit Group</time></h3>
                            </div>
                        </div>
                    </a>
                <?php } } 
                if ($users[0]["rank"] == 1){
                    foreach ($name_asker as $ask){
                        print($ask);
                    }
                 } ?>
            </div>
        </div>
 
        <script>
  
        function ManageGroup(type) {
            if (type == "left" && window.confirm("Are you sure you want to quit the group ?")) {
                $.post("/api/group-manage?type="+type+"&group=<?= $ID ?>")
                location.reload();
            }
            else if (type != "left") {
                $.post("/api/group-manage?type="+type+"&group=<?= $ID ?>")
                location.reload();
            }
            
        };

    </script>   

<?php } GenerateFooter(); ?>