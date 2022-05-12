<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/generalHelper.php");
    require_once("./php/sql.php");


    $ID = $_GET["id"];
    $Group = GetGroupData($ID);
    GenerateHeader("../../banners/".$ID, "Group Profil", 200);

    $self = GetID();


    $selectuser = $pdo->prepare("SELECT UID FROM user_groups WHERE groupes_id = :id");
    $selectuser->execute([
        ":id"   => $ID,
    ]);
    $group_membre = $selectuser->fetchAll();

    $nb_user = pdo->prepare("SELECT COUNT(*) rows FROM user_groups WHERE GID = :id");
    $nb_user->execute([
        ":id" => $ID,
    ]);
    $numbre_users = $nb_user->fetchAll();

    $priv = pdo->prepare("SELECT is_private FROM user_groups WHERE GID = :id");
    $priv->execute([
        ":id" => $ID,
    ]);
    $private = $pric->fetchAll();
?>

<div class="ui container">
    <div class="profile-bg" style="background-image: url('/banners/group/<?= $ID ?>');">
        <div class="overlay"></div>
        <div class="profile">
            <div class="profile-data">
                <div class="cat">
                <div class="rank">
            
            </div>
                <div class="stats">
                    <h1 class="username"><?= $Group["name"] ?></h1>
                    <h1 style="margin: 0;color: #5f5;text-shadow: 0 0 6px black;"><?= $numbre_users ?></h1>
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
            
        </div>
    
        
        <div class="right-panel">
            <div class="ui raised segment">
                
                <?php if ($group_membre == False) { 
                    if ($private == False) {?>
                    <div class="tab">
                        <div class="label" style="box-shadow: 0 0 5px 1px #2558ff;background: #2558ff;position: relative;">
                            <button><h3><i class="circular icon sign in icon"></i>> Join Group</time></h3></button>
                            <? $grp = pdo->prepare("INSERT INTO groups_users (GID, rank, UID) value (:group_id, 1, :user_id)");
                            $grp->execute([
                                ":group_id" => $ID, 
                                ":user_id"  => $self,
                            ]); ?>
                        </div>
                    </div>
                <?php } ?>

                <?php if ($private == True) {?>
                    <div class="tab">
                        <div class="label" style="box-shadow: 0 0 5px 1px #2558ff;background: #2558ff;position: relative;">
                            <button><h3><i class="circular icon sign in icon"></i>> Demande To Join Group</time></h3></button>
                        </div>
                    </div>
                <?php } }?>

                <?php if ($group_membre == True) { ?>
                    <div class="tab">
                        <div class="label" style="box-shadow: 0 0 5px 1px #2558ff;background: #2558ff;position: relative;">
                            <button><h3><i class="circular icon sign in icon"></i>> Quit Group</time></h3></button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
 

<?php GenerateFooter(); ?>