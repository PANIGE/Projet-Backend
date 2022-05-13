<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/sql.php");
    $pdo = getpdo();
    GenerateHeader("default.jpg", "publication", 220);
    RequireLogin();
    require_once("./php/generalHelper.php");


    if(isset($_POST['send'])){
        if ( !empty($_POST['title']) && !empty($_POST['message']))
        {
            $author = GetID();
            $post_title = htmlspecialchars($_POST['title']);
            $post_message = nl2br(htmlspecialchars($_POST['message']));
            
            $store_post = $pdo->prepare("INSERT INTO posts (UID, title, message, unix)VALUES(:UID, :title, :message, :time)");
            $store_post->execute([
                ":UID"     => $author,
                ":title"   => $post_title,
                ":message" => $post_message,
                ":time"    => time(),
            ]);
            $req = $pdo->prepare('SELECT LAST_INSERT_ID() id;');
            $req->execute(); 
            $id = $req->fetch(PDO::FETCH_ASSOC)["id"];
            $uploaddir = $uploaddir = $_SERVER['DOCUMENT_ROOT']."/postsStorage/".$id.".png";

            if (move_uploaded_file($_FILES['pub']['tmp_name'], $uploaddir)) {
                http_response_code(302);
                header("location:/posts/".$id."?es=Post%20published%20successfully");
            } else {
                http_response_code(302);
                header("location:/post?er=Post%20Could%20not%20be%20submitted");
            }


            die();
        }
        else {
            http_response_code(302);
            header("location:/post?er=You%20Have%20To%20Complete%20The%20Form");
            die();
        };
    }
?>
    

<html>
    <div class="ui centered segment">
        <form method="POST" class="ui form" enctype="multipart/form-data">
            <input tabindex="1" type="file" id="file" style="display:none" required="" accept="image/*" name="pub" onchange="UpdateImg(event)">
            <div class="title_part">
                <h1 id="newpost">New post</h1>

                
                <input tabindex="2" type="text" name="title" id="ttl" placeholder="Title Your Message"></input>
            </div>
            
            <div class="ui divider"></div>
            <div class="message_part">
                <textarea tabindex="3" name="message" id="msg" placeholder="Enter Your Message" ></textarea>
            </div>
            <div class="ui divider"></div>
            <img id="image" style="display:none;">
            <div class="ui divider"></div>
            <div class="option_part">
                
                        <label for="file" class="ui blue inverted labeled icon button">
							<i class="file icon"></i>
							Ouvrir le fichier
						</label>
                        <label for="file" class="ui blue inverted right labeled icon button">
							<i class="smile icon"></i>
							Emotes
						</label>
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
 