<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/php/htmlHelper.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
    GenerateHeader("settings.jpg", "Settings", 200);
    RequireLogin();
    
?>
 <div class="ui four column divided stackable grid">

 <div class="row">
 <div class = "ui segment column" style="margin:0.5em"></div>
 <div class = "ui segment column" style="width:calc(75% - 1em);margin:0.5em"></div>
</div>

 </div>


<?php GenerateFooter(); ?>
 