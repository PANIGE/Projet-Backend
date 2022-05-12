<?php

require_once($_SERVER['DOCUMENT_ROOT']."/php/navbar.php");
?>

<div class="four wide column">
	<div class="ui fluid vertical menu">
		<?php Item("Profile", "/settings/profile"); ?>
		<?php Item("Avatar", "/settings/avatar"); ?>
		<?php Item("Banner", "/settings/banner"); ?>
		<?php Item("Delete", "/settings/Delete"); ?>
        </div>
</div>