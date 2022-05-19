<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/sql.php");
    $pdo = getpdo();
    RequireLogin();
    require_once("./php/generalHelper.php");


    if(isset($_POST['send'])){
        if ( !empty($_POST['title']) && !empty($_POST['message']))
        {
            $author = GetID();
            $name = htmlspecialchars($_POST['title']);
            $description = nl2br(htmlspecialchars($_POST['message']));
            
            $store_page = $pdo->prepare("INSERT INTO pages (name, description) VALUES (:name, :desc)");
            $store_page->execute([
                ":name" => $name,
                ":desc" => $description,
            ]);
            $req = $pdo->prepare('SELECT LAST_INSERT_ID() id;');
            $req->execute(); 
            $id = $req->fetch(PDO::FETCH_ASSOC)["id"];

            $store_post = $pdo->prepare("INSERT INTO user_pages (UID, PID) VALUES (:uid, :pid)");
            $store_post->execute([
                ":uid" => GetID(),
                ":pid" => $id,
            ]);


            http_response_code(302);
            header("location:/pages/".$id."?es=Your%20new%20page%20is%20online");
            die();
        }
        else {
            http_response_code(302);
            header("location:/post?er=You%20Have%20To%20Complete%20The%20Form");
            die();
        };
    }

    
    GenerateHeader("default.jpg", "New Page", 220);
?>
    

<html>
    <div class="ui centered segment">
        <form method="POST" class="ui form" enctype="multipart/form-data">
            <div class="title_part">
                <h1 id="newpost">New Page</h1>

                
                <input tabindex="2" type="text" name="title" id="ttl" placeholder="How should we call it ?"></input>
            </div>
            
            <div class="ui divider"></div>
            <div class="message_part">
                <textarea tabindex="3" name="message" id="msg" placeholder="What is that all about ?" ></textarea>
            </div>
            
            <div class="ui divider"></div>
            <div>
                <button name="send" class="ui huge primary button" type="submit" id="sbmt"> publish </button>  
            </div>

        </form>
            
        <script>
            function UpdateImg(e) {
                $('#image').attr("src", (window.URL || window.webkitURL).createObjectURL(event.target.files[0]));
                $('#image').attr("style", "");
            }
        </script>
    </div>
</html>




<?php GenerateFooter(); ?>
 