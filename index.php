<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/sql.php");
    GenerateHeader("homepage.jpg", "Home Page");
?>

<div class="vid-container">
                <video class="main-menu-vid" autoplay="" loop="" muted="" playsinline="" src="/static/assets/video.mp4"></video>
                <img class="main-vid-img" id="san" src="/static/icon.png"> 
                <div class="main-menu-message">
                   <h1>Welcome to Ultraverse</h1>
                   <h3>Welcome to the Weeb version of Metaverse, METAVERSE 0, ULTRAVERSE 1</h3>
                   
                </div>
             </div>

<?php GenerateFooter(); ?>
 