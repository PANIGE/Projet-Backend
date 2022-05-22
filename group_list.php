<?php
    require_once("./php/htmlHelper.php");
    require_once("./php/generalHelper.php");
    require_once("./php/sql.php");
    $pdo = getpdo();
    RequireLogin();
    $ID = GetID();
    GenerateHeader("../../banners/".$ID, "Group List", 200);

    $group_all = $pdo->prepare("SELECT name, id, is_private FROM groups");
    $group_all->execute();
    $Group = $group_all->fetchAll(PDO::FETCH_ASSOC);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $GID = filter_input(INPUT_POST, "numbre");
        header('location:/groups/'.$GID);
    }
    foreach ($Group as $value){
    ?>


    <a href="/groups/<?= $value["id"] ?>" style="color:white">
    <div class="ui container">
    <div class="profile-bg" style="background-image: url('/banners/-1');">
        <div class="overlay"></div>
        <div class="profile">
            <div class="profile-data">
                <div class="cat">
                <div class="rank">

            </div>
            
                <div class="stats">
                    <h1 class="username"><?= $value["name"]; ?> </h1>
                    </div>
                </div>
            </div>
            

            <div class="p-avatar">
                <img height="256" alt="avatar" src="/avatars/-1">
            </div>
        </div>
    </div>
                    </div>
    </input>
                    <br><br>
    </a>
                    <?php } ?>
        


<?php  GenerateFooter(); ?>