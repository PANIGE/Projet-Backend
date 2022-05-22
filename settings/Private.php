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
					<p>Set your account to public/private account, having a private account :</p>
					<ul>
						<li>Only the people you follow can see your profile</li>
					</ul>
					<div style="text-align: right">
						<?php if (Context()["User"]["private"] == 0) { ?>
							<button class="ui huge blue inverted button" onclick="private(<?= $id ?>)" >Set private</button>
						<?php } else { ?>
							<button class="ui huge blue inverted button" onclick="private(<?= $id ?>)" >Set public</button>
						<?php } ?>
					</div>
			</div>
		</div>
	</div>
	<script>
		function private(id) {
            $.post("/api/swap_private");
			location.reload();
		}
	</script>
</div>

	

<?php GenerateFooter(); ?>