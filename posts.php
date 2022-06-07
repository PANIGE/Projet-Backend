<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/generalHelper.php");
    require_once("./php/sql.php");
    $pdo = getpdo();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if(!key_exists("content", $_POST)) {
            http_response_code(400);
            die();
        }
        $content=$_POST["content"]; // texte du commentaire; c'est un INPUT // Vérifier si le content est présent
        $UID=GetID(); // id de l'utilisateur
                            //utiliser l'ID

        if (key_exists("cid", $_POST)) {
            $CID = $_POST["cid"];
            $commentaire=$pdo->prepare('INSERT INTO `ultraverse`.`posts_comments` (`UID`, `CID`, `content`, `unix`) VALUES (:user, :CID, :content, :time )');
            $commentaire->execute([
            ":content" => $content,
            ":user" => $UID,
            ":CID" => $CID,
            ":time" => time(),
            ]);
        }
        else {
            $PID=$_GET["id"]; // id du post // Verifier si l'ID est dans la SQL
            $commentaire=$pdo->prepare('INSERT INTO `ultraverse`.`posts_comments` (`UID`, `PID`, `content`, `unix`) VALUES (:user, :postID, :content, :time )');
            $commentaire->execute([
            ":content" => $content,
            ":user" => $UID,
            ":postID" => $PID,
            ":time" => time(),
            ]);
        }

        


        http_response_code(302);
        header("location:".$_SERVER['REQUEST_URI']);
    }
    
    GenerateHeader("default.jpg", "publication", 220);
    RequireLogin();
    
    $ID = $_GET["id"];
   
    $post_content=$pdo->prepare('SELECT id, UID, title, message, unix FROM posts WHERE id= :id');
    $post_content->execute([
        ":id"      => $ID,
    ]);
    
    $Post = $post_content->fetch(PDO::FETCH_ASSOC);
    $User = GetUserData($Post["UID"]);
    $title = ParseEmotes($Post["title"]);
    $message = ParseEmotes($Post["message"]);
    $user_name = $User["username"];
    //GetRelativeTime(unix) -> "X time ago"
    $postFormattedDate = date("F j, Y" ,$Post["unix"]);


    
?>

    <div class = "ui raised segment" >
        
    <div class = "user_and_title" >
            
            <div class = "title" >
                <h3> <?php echo $title ?> 
                <a href="/users/<?= $Post["UID"] ?>">
                <span style="float: right;color: var(--highLight-bg);">
                              <img src="/avatars/<?= $Post["UID"] ?>" style="height: 1.5em;margin-bottom: -0.4em;margin-right: 0.5em;border-radius: 5em;">
                              <?= $user_name ?></a>
                           </span>  </h3>
            </div>

        </div>
        
        <div class="ui divider"></div>

        <div class = "content" >
            <div style="text-align: center;background: var(--background-hue);border-radius: .5em;">
                           <img style="max-height:50em" src="/postsStorage/<?= $Post["id"] ?>.png">
                        </div>
                        </h2><div class="ui divider"></div><p><?= $postFormattedDate." (".GetRelativeTime($Post["unix"]).")" ?></p>
            <div class = "text" >
                <p> <?php echo $message ?> </p>
                <div class = "image" >
            </div>

            </div>
        </div>
        <div class="score">
            <script src="https://use.fontawesome.com/fe459689b4.js"></script>

            <button class="btn" id="green"><i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
            <button class="btn" id="red"><i class="fa fa-thumbs-down" aria-hidden="true"></i></i></button>
        </div>


    </div>
    <h3 class = "ui horizontal divider header">Comments</h3>
            
    <div class = "ui segment" >
        <form method="post" action="/posts/<?= $Post["id"] ?>" class="ui form" enctype="multipart/form-data">
        <input type="text" name="content" id="comment-content">
        <div class="ui divider"></div>
            
            <!-- <div style="text-align:center"> -->
            <div class = "option">
                <div class= "emote_section">
                    <button class= "emote" id = "happy">&#128512</button>
                    <button class= "emote" id = "angry">&#128544</button>
                    <button class= "emote" id = "sad">&#128542</button>
                    <button class= "emote" id = "emotionless">&#128528</button>
                </div>
                
                <button class="ui huge inverted blue button" type="submit" id="sbmt"> publish </button>
            </div>

        </form>
    </div>

    <style>
        .btn{
        cursor: pointer;
        outline: 0;
        color: #AAA;
        }

        .btn:focus {outline: none;}

        .green{color: green;}

        .red{color: red;}
        
        .emote{
            color:black;
            font-size: 1.5rem;
            -webkit-appearance: none;
            background: grey;
            height: 40px;
            width: 40px;
            margin-right:3%;
            margin-top:3%;
            border: none;
            border-radius: 50%;
        }
        .emote:hover{ transition: transform 2s; transform:rotate(360deg);}
        .emote_section{width: 40%;}
        .option{display:flex; justify-content: space-between;}
    </style>

    <?php 
        $req=$pdo->prepare('SELECT id, UID, content, unix FROM ultraverse.posts_comments WHERE PID = :id ORDER BY unix DESC;');
        $req->execute([
            ":id"      => $ID,
        ]);

        while ($msg = $req->fetch()) {  ?>

            <div class="ui segment">
                <h3><a style="color:white" href="/users/<?= $msg["UID"] ?>"><img src="/avatars/<?= $msg["UID"] ?>" style="height: 1.5em;margin-bottom: -0.4em;margin-right: 0.5em;border-radius: 5em;"><?= GetUserData($msg["UID"])["username"] ?></a><a onclick="reply(<?= $msg["id"] ?>)" style="float:right" class="ui small inverted green button">Reply</a></h3>
                <div class="ui divider"></div>
                <p><?= ParseEmotes($msg["content"]) ?></p>
                <p style="text-align:right;color: var(--highLight-bg);"><?= GetRelativeTime($msg["unix"]) ?></p>
                <div id="comment-<?= $msg["id"] ?>"></div>
            </div>
            <?php 
                $r=$pdo->prepare('SELECT UID, content, unix FROM ultraverse.posts_comments WHERE CID = :id ORDER BY unix ASC;');
                $r->execute([
                    ":id"      => $msg["id"],
                ]);
                while ($rep = $r->fetch()) { ?>
            <div style="width: 90%;margin-left: 10%;" class="ui raised segment">
            <h3><a style="color:white" href="/users/<?= $rep["UID"] ?>"><img src="/avatars/<?= $rep["UID"] ?>" style="height: 1.5em;margin-bottom: -0.4em;margin-right: 0.5em;border-radius: 5em;"><?= GetUserData($rep["UID"])["username"] ?></a><span style="float:right;color: var(--highLight-bg);font-size: small;"><?= GetRelativeTime($rep["unix"]) ?></span></h3>
                <div class="ui divider"></div>
                <p><?= ParseEmotes($rep["content"]) ?></p>
                
        </div>
            <?php } ?>

    <?php } ?>
<script>
    function reply(id) {
        $('[id^="comment-"]').html("");
        $('#comment-'+id).html('<form method="post" class="ui form" action="/posts/<?= $Post["id"] ?>"><input type="text" name="content"><input type="text" style="display:none" value="'+id+'" name="cid"><div style="text-align:right"><button style="margin: 1em 1em -1.5em 0em;" class="ui mini inverted green button" type="submit">reply</button></div>  </form>')
    }
</script>
<?php GenerateFooter(); ?>
 