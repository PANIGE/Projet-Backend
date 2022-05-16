<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/php/htmlHelper.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/php/generalHelper.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
     $pdo = GetPDO();
    GenerateHeader("settings.jpg", "Settings > Profile", 200);
    RequireLogin();
    $User = Context()["User"];
	if (isset($_POST['username'])) {
		$new_name= $_POST['username'];
		$id = GetID();
		$New = $pdo->prepare("UPDATE `users` SET `username` = :username WHERE ID = :id");
		$New->execute([
		":username"=>$new_name,
		":id"=>$id,
		]);
    }
?>
<div class="ui container">
	<div class="ui stackable grid">
        <?php require($_SERVER['DOCUMENT_ROOT']."/settings/sidemenu.php") ?>
		<div class="twelve wide column">
			<div class="ui segment">
				<form id="settings-form" class="ui form" method="post" action="/settings/profile">
					<h3 class="ui header">General</h3>
					<div class="field">
						<label>
							Username
						</label>
						<input type="text" name="username" value="<?= $User["username"]; ?> ">
					</div>
	
					<div style="text-align: right">
						<button type="button" class="ui red button" onclick="disableAccount()">Disable Account</button>
						<button type="submit" class="ui blue button">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>

		function disableAccount() {
			if (window.confirm("Disabling your account will set you hidden to everyone until your next login, are you sure you want to do this")) {
				$.post("/api/disable");

				window.location.href = "/logout";
			}
		}
	</script>
</div>

<?php GenerateFooter(); ?>
 