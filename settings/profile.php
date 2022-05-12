<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/php/htmlHelper.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/php/generalHelper.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
     $pdo = GetPDO();
    GenerateHeader("settings.jpg", "Settings > Profile", 200);
    RequireLogin();
    $User = Context()["User"];
    
?>
<div class="ui container">
	<div class="ui stackable grid">
        <?php require($_SERVER['DOCUMENT_ROOT']."/settings/sidemenu.php") ?>
		<div class="twelve wide column">
			<div class="ui segment">
				<form id="settings-form" class="ui form" method="post">
					<h3 class="ui header">General</h3>
					<div class="field">
						<label>
							Username
						</label>
						<input type="text" name="username" value="<?= $User["username"]; ?>" disabled>
					</div>

					

					<div style="text-align: right">
						<button type="submit" class="ui blue button">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php GenerateFooter(); ?>
 