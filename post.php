<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/sql.php");
    GenerateHeader("default.jpg", "publication", 220);
    RequireLogin();
    require_once("./php/generalHelper.php");


    if(isset($_POST['send'])){
        if ( !empty($_POST['title']) && !empty($_POST['message']))
        {
            $author = GetID();
            $post_title = htmlspecialchars($_POST['title']);
            $post_message = nl2br(htmlspecialchars($_POST['message']));
            $store_post = $pdo->prepare("INSERT INTO posts(UID,title,message)VALUES(:UID,:title,:message)");
            $store_post->execute([
                ":UID"     => $author,
                ":title"   => $post_title,
                ":message" => $post_message,
            ]);
            var_dump($_FILES);

            http_response_code(302);
            header("location:/post?es=Your%20Message%20Have%20Been%20Sent");
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
        <form method="POST" class="ui form">

            <div class="title_part">
                <h1 id="newpost">New post</h1>
                
                <input type="text" name="title" id="ttl" placeholder="Title Your Message"></input>
            </div>
            
            <div class="ui divider"></div>
            <div class="message_part">
                <textarea name="message" id="msg" placeholder="Enter Your Message" ></textarea>
            </div>
            <div class="ui divider"></div>
            <img id="image" style="display:none;">
            <div class="ui divider"></div>
            <div class="option_part">
                <input type="file" id="file" style="display:none" required="" accept="image/*" name="pub" onchange="UpdateImg(event)">
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
 