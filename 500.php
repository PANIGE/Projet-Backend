<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/sql.php");
    $pdo = GetPDO();
    GenerateHeader("stop_sign.png", "Internal server error");
?>
 <div class="ui centered segment">An error occured</div>


<?php GenerateFooter(); ?>
 