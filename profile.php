<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/generalHelper.php");
    require_once("./php/sql.php");
    

    $ID = $_GET["id"];
    $User = GetUserData($ID);
    GenerateHeader("../../banners/".$ID, "User Profile", 200);

    $r = $pdo->prepare("SELECT icon, title FROM ultraverse.badges WHERE ID in (SELECT  BID from user_badge where UID = :id);");
    $r->execute([
        ":id" => $User["id"]
    ]);
    $badges = $r->fetchAll(PDO::FETCH_ASSOC);

    $self = $ID == GetID();

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
                            <div class="label" style="border: 2px solid;box-shadow: 0 0 4px 0px; position:relative; color: #494949;">
                                <h3><i class="circular plus icon"></i>Loading</h3>
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
             
             
    

<?php GenerateFooter(); ?>