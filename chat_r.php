 <?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/sql.php");
    $pdo = GetPDO();
    RequireLogin();
    
    $chan = $_GET["chan"];

    if (str_starts_with($chan, "#")) {
        $req = $pdo->prepare("SELECT 1 FROM ultraverse.channels WHERE name = :name;");
        $req->execute([":name" => $chan]);
        $req->fetchAll();
        if ($req->rowCount() == 0) {
            http_response_code(404);
            echo render_php("404.php");
            die();
        }
        else {
            GenerateHeader("register.jpg", "Chat > ".$chan , 150);
        }
    }
    elseif (str_starts_with($chan, "~")) {
       http_response_code(404);
       echo render_php("404.php");
       die();
        
    }
    elseif (is_numeric($chan)) {
        if (!GetUserData($chan)) {
            http_response_code(404);
            echo render_php("404.php");
            die();
        }
        else {
            GenerateHeader("register.jpg", "Chat > ".GetUserData($chan)["username"] , 150);
        }
    }
    else {
        http_response_code(404);
        echo render_php("404.php");
        die();
    }

    
    if (isset($_POST['chat'])) {
        $message= nl2br(htmlspecialchars($_POST['chat']));
        $inserer_message = $pdo->prepare('INSERT INTO messages (message, uid, channel) VALUES(?, ?, ?)');
        $inserer_message->execute(array(htmlspecialchars($message, ENT_QUOTES), GetID(), $chan));
        die();
    }

?>
<div id="chatdiv" style="height: 72%;overflow: scroll;">
        <div id="message"></div>
</div>
 <form id="chat" class="ui form" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>" >
    
    <div class="field">    
        <input id type="text" name="chat" placeholder="send message" required id="messageInput">
    </div>
    
        <section id="message">

        </section>

    <script> 
        var lastMSGID = 0;
        setInterval('load_message()',1000);
        function load_message() {
            $('#message').load('/load_chat.php?chan=<?= urlencode($chan) ?>');
            /*

            */

            let t = $('div.channel-message-tab:last').attr("id");
            if (t != lastMSGID) {
                lastMSGID = t
                $('#chatdiv').animate({
                scrollTop: 90000
            },0);
            }

        }
        let form = $("#chat")
        form.submit(function(){
            $.post($(this).attr('action'), $(this).serialize(), function(response){},'json');
            console.log("A");
            setTimeout(() => {
                $("#messageInput").val('')
                form.removeClass("loading");
            }, 1000);
            
            return false;
        });
        

        function delete_msg(id) {
            $.post("/api/message_delete?id="+id);
        }

        function edit_msg(id) {
            $msg = prompt("Edit your message", $("#msg-"+id).attr("cont"))
            $.post("/api/edit?id="+id+"&msg="+$msg);
        }
        

    </script>
</form>

<?php GenerateFooter(); ?>