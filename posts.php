<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/generalHelper.php");
    require_once("./php/sql.php");
    $pdo = getpdo();
    GenerateHeader("default.jpg", "publication", 220);
    RequireLogin();
    
    $ID = $_GET["id"];
   

    $post_content=$pdo->prepare('SELECT UID, title, message FROM POST WHERE id= :id');
    $post_content->execute([
        ":id"      => $ID,
    ]);
    $Post = $post_content->fetch(PDO::FETCH_ASSOC);
    $User = GetUserData($res["UID"]);


    
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
 