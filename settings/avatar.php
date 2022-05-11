<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/php/htmlHelper.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/php/generalHelper.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
	RequireLogin();
	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/avatars/".GetId().".png";
		
		if(file_exists($uploaddir)) {
			unlink($uploaddir);
		} 

		if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploaddir)) {
			http_response_code(302);
			header("location:/settings/avatar?es=Avatar%20Successfully%20Changed");
		} else {
			echo $_FILES;
			die();
			http_response_code(302);
			header("location:/settings/avatar?er=Avatar%20Could%20not%20be%20changed");
		}

        die();
        $Name     = filter_input(INPUT_POST, "username");
        $SafeName = GetSafeUsername($Name);
        $PW       = filter_input(INPUT_POST, "password");
    }


    GenerateHeader("settings.jpg", "Settings > Avatar", 200);
    
    $User = Context()["User"];
    
	

?>
<div class="ui container">
	<div class="ui stackable grid">
		<?php require($_SERVER['DOCUMENT_ROOT']."/settings/sidemenu.php") ?>
		<div class="twelve wide column">
			<div class="ui center aligned segment">
				<div class="ui compact segment" style="margin: 0 auto;">
					<img src="/avatars/<?= $User["id"] ?>" alt="Avatar" id="avatar-img" style="max-width: 400px;">
				</div>
				<form action="/settings/avatar" method="post" enctype="multipart/form-data" class="little top margin">
					
					<div class="ui buttons">
						<label tabindex="1" for="file" class="ui green labeled icon button">
							<i class="file icon"></i>
							Ouvrir le fichier
						</label>
						<button tabindex="2" type="submit" class="ui right labeled blue icon button">
							<i class="save icon"></i>
							Sauvegarder	
						</button>
					</div>
					<input type="file" id="file" style="display:none" required accept="image/*" name="avatar" onchange="UpdateImg(event)">
				</form>
				<script>
					function UpdateImg(e) {
						$('#avatar-img').attr("src", (window.URL || window.webkitURL).createObjectURL(event.target.files[0]));
					}
				</script>
			</div>
		</div>
	</div>
</div>

<?php GenerateFooter(); ?>