<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/sql.php");
    RequireLogin();
    GenerateHeader("register.jpg", "chat", 150);
    if (isset($_POST['chat'])) {
        $message= nl2br(htmlspecialchars($_POST['chat']));
        $inserer_message = $pdo->prepare('INSERT INTO messages (message, uid, channel) VALUES(?, ?, ?)');
        $inserer_message->execute(array(htmlspecialchars($message, ENT_QUOTES), GetID(), "#general"));
    }
?>
<div id="chatdiv" style="height: 72%;overflow: scroll;">
    <div id="message"></div>
</div>
 <form id="chat" class="ui form" method="post" action="/chat.php" >

     <div class="field">    
        <input type="text" name="chat" placeholder="send message" required id="messageInput">
    </div>
    
        <section id="message">

        </section>

    <script> 
        setInterval('load_message()',1000);
        function load_message() {
            $('#message').load('load_chat.php');
            /*
            $('#chatdiv').animate({
                scrollTop: 90000
            },0);
            */
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
        
    </script>
</form>

<?php GenerateFooter(); ?>