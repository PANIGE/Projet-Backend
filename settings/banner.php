<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/php/htmlHelper.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/php/generalHelper.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/php/sql.php");
	RequireLogin();
	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/banners/".GetId().".png";
		
		if(file_exists($uploaddir)) {
			unlink($uploaddir);
		} 

		if (move_uploaded_file($_FILES['banner']['tmp_name'], $uploaddir)) {
			http_response_code(302);
			header("location:/settings/banner?es=Banner%20Successfully%20Changed");
		} else {
			echo $_FILES;
			die();
			http_response_code(302);
			header("location:/settings/banner?er=Banner%20Could%20not%20be%20changed");
		}

        die();
        $Name     = filter_input(INPUT_POST, "username");
        $SafeName = GetSafeUsername($Name);
        $PW       = filter_input(INPUT_POST, "password");
    }


    GenerateHeader("settings.jpg", "Settings > Banner", 200);
    
    $User = Context()["User"];
    
	

?>
<div class="ui container">
	<div class="ui stackable grid">
		<?php require($_SERVER['DOCUMENT_ROOT']."/settings/sidemenu.php") ?>
		<div class="twelve wide column">
			<div class="ui center aligned segment">
				<div class="ui compact segment" style="margin: 0 auto;">
					<img src="/banners/<?= $User["id"] ?>" alt="Banner" id="banner-img" style="max-width: 400px;">
				</div>
				<form action="/settings/banner" method="post" enctype="multipart/form-data" class="little top margin">
					
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
					<input type="file" id="file" style="display:none" required accept="image/*" name="banner" onchange="UpdateImg(event)">
				</form>
				<script>
					function UpdateImg(e) {
						$('#banner-img').attr("src", (window.URL || window.webkitURL).createObjectURL(event.target.files[0]));
					}
				</script>
			</div>
		</div>
	</div>
</div>

<?php GenerateFooter(); ?>