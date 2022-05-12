<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/php/htmlHelper.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/php/generalHelper.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
     $pdo = GetPDO();
    GenerateHeader("settings.jpg", "Settings > Profile", 0);
    RequireLogin();
    $id = GetID();
    
?>
<div class="ui container">
	<div class="ui stackable grid">
        <?php require($_SERVER['DOCUMENT_ROOT']."/settings/sidemenu.php") ?>
		<div class="twelve wide column">
			<div class="ui segment">
					<h3 class="ui header">DELETE</h3>
					<p>The button in here will delete your account for good, this is the <span style="color:red">BIG RED BUTTON</span> of your account</p>
					<div style="text-align: right">
						<button class="ui huge red inverted button" onclick="delete_profile(<?= $id ?>)" >DELETE</button>
					</div>
			</div>
		</div>
	</div>
	<script>
		function delete_profile(id) {
			if (window.confirm("Are you sure you want to do this")) {
				if (window.confirm("this gonna delete your account. FOR GOOD. FOREVER, you'll have to make one again")) {
					if (window.confirm("LAST WARN, THIS IS IRREVERSIBLE AND YOU WILL SAY YOUR ACCOUNT GOODBYE")) {
						$.post("/api/profile_delete?id="+id);
						window.location.href = "/logout";
					}
				}
			}

		}
	</script>
</div>

	

<?php GenerateFooter(); ?>
 