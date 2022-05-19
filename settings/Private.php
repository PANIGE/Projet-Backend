<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/php/htmlHelper.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/php/generalHelper.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
     $pdo = GetPDO();
    GenerateHeader("settings.jpg", "Settings > Profile", 200);
    RequireLogin();
    $id = GetID();
    
?>
<div class="ui container">
	<div class="ui stackable grid">
        <?php require($_SERVER['DOCUMENT_ROOT']."/settings/sidemenu.php") ?>
		<div class="twelve wide column">
			<div class="ui segment">
					<h3 class="ui header">Private</h3>
					<p>Private or public ?</p>
					<div style="text-align: right">
						<button class="ui huge blue inverted button" onclick="private(<?= $id ?>)" >private</button>
					</div>
			</div>
		</div>
	</div>
	<script>
		function private(id) {
            $.post("/api/swap_private");
		}
	</script>
</div>

	

<?php GenerateFooter(); ?>