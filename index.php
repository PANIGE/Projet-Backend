<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/sql.php");
    $pdo = GetPDO();
    GenerateHeader("homepage.jpg", "Home Page");
?>

<?php if (!IsLog()) { ?>
<div class="vid-container">
         <video class="main-menu-vid" autoplay="" loop="" muted="" playsinline="" src="/static/assets/video.mp4"></video>
         <img class="main-vid-img" id="san" src="/static/icon.png"> 
         <div class="main-menu-message">
            <h1>Welcome to Ultraverse</h1>
            <h3>Welcome to the Weeb version of Metaverse, METAVERSE 0, ULTRAVERSE 1</h3>
                  
            </div>
      </div>

      <?php } else { 
         $req = $pdo->prepare("SELECT * FROM ultraverse.posts where UID in (SELECT `to` FROM ultraverse.relations where fro = :id) order by unix desc;");
         $req-> execute([":id"=>GetID()]);
         $posts = $req->fetchAll();

         if (sizeof($posts) == 0 ) {
         ?>
            <div class="ui segment">It seems you don't follow anybody, why don't you say hi in our <a style="margin-left: 1em" class="ui small blue inverted button" href="/chat/%23general">general chat</a></div>
         <?php }  else { foreach ($posts as $post) { 
               if (GetUserData($post["UID"])["enabled"] != 1) {
                  continue;
              }
            ?>
                <a href="/posts/<?= $post["id"] ?>" style="color:white;" >
                    <div class="ui raised segment" style="margin: 0 0 0.5em 0;">
                        <h2><?= $post["title"]; ?>
                           <span style="float: right;color: var(--highLight-bg);">
                              <img src="/avatars/<?= $post["UID"] ?>" style="height: 1.5em;margin-bottom: -0.4em;margin-right: 0.5em;border-radius: 5em;">
                              <?= GetUserData($post["UID"])["username"] ?>
                           </span> 
                        </h2><div class="ui divider"></div><p><?= $post["message"] ?></p>
                        <div style="text-align: center;background: var(--background-hue);border-radius: .5em;">
                           <img style="max-height:50em" src="/postsStorage/<?= $post["id"] ?>.png">
                        </div>
                        </h2><div class="ui divider"></div><p><?= date("F j, Y" ,$post["unix"])." (".GetRelativeTime($post["unix"]).")" ?></p>
                    </div>
                </a>
            <?php } } ?>
         

      <?php }?>

<?php GenerateFooter(); ?>
 