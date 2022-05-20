<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/generalHelper.php");
    require_once("./php/sql.php");
    $pdo = getpdo();
    

    $ID = $_GET["id"];
    $req = $pdo->prepare("SELECT * FROM ultraverse.pages where id = :id;");
    $req->execute([":id" => $ID]);
    $Page = $req->fetch();
    if (!$Page) {
        http_response_code(404);
        echo render_php('404.php');
        die();
    }


    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $req = $pdo->prepare("SELECT UID FROM ultraverse.user_pages where PID = :id AND UID = :uid;");
        $req->execute([":id" => $ID, ":uid" => GetID()]);
        var_dump($req->rowCount());
        if ($req->rowCount() < 1) {
            http_response_code(403);
            die();
        }
        switch ($_GET["type"]) {
            case "avatar":
                $uploaddir = $_SERVER['DOCUMENT_ROOT']."/pageAvatars/".$ID.".png";
                break;
            case "banner":
                $uploaddir = $_SERVER['DOCUMENT_ROOT']."/pageBanners/".$ID.".png";
                break;
            default:
                http_response_code(400);
                die();
                break;
        }
		
		
		if(file_exists($uploaddir)) {
			unlink($uploaddir);
		} 

		if (move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir)) {
			http_response_code(302);
            header("Refresh:0");
        }
        die();
    }

    GenerateHeader("../../pbanners/".$ID, "Page", 200);
  

?>

<div class="ui container">
    <div class="profile-bg" style="background-image: url('/banners/<?= $ID ?>');">
        <div class="overlay"></div>
        <div class="profile">
            <div class="profile-data">
                <div class="cat">
                <div class="rank">
            
                    
                    
                </div>
                <div class="stats">
                    <h1 class="username"><?= $Page["name"] ?></h1>
                    
             
                        <h1 style="margin: 0;color: #ffc700;text-shadow: 0 0 6px black;">Ultraverse Page</h1>
         

                    <h3 style="margin: 0;color: #fff;text-shadow: 0 0 6px black;"> <?= $Page["description"] ?></h1>
                </div>
                </div>
            </div>
            
            
            <div class="p-avatar">
                <img height="256" alt="avatar" src="/pavatars/<?= $ID ?>">
            </div>
        </div>
    </div>
    
    <div class="profile-segment">

        <div class="left-panel">
            
        </div>
    
        
        <div class="right-panel">
            <div class="ui raised segment">
                <?php 
                    $req = $pdo->prepare("SELECT UID FROM ultraverse.user_pages where PID = :id;");
                    $req->execute([":id" => $ID]);
                    $ids = $req->fetchAll();
                    foreach ($ids as $id) {
                ?>
                    <a href="/users/<?= $id["UID"] ?>">
                        <div class="hoverable tab">
                            <div class="label" style="box-shadow: 0 0 5px 1px #6500ff;background: #6500ff;position: relative;">
                                <h3><img src="/avatars/<?= $id["UID"] ?>"><?= GetUserData($id["UID"])['username'] ?></h3>
                            </div>
                        </div>
                    </a>
                <?php } ?>
                <div class="ui divider"></div>
                <?php 
                    $req = $pdo->prepare("SELECT UID FROM ultraverse.user_pages where PID = :id AND UID = :uid;");
                    $req->execute([":id" => $ID, ":uid" => GetID()]);
                    if ($req->rowCount() == 1) {
                ?>
                <a href="#" onclick="$('#file-avatar').trigger('click')">
                    <form id="avatar-change" method="post" style="display:none" action="<?= $_SERVER["REQUEST_URI"] ?>?type=avatar" enctype="multipart/form-data" >
                        <input type="file" id="file-avatar" required accept="image/*" name="file" onchange="$('#avatar-change').submit()">
                    </form>
                    <label style="display:block" for="file-avatar" class="hoverable tab">
                        <div class="label" style="box-shadow: 0 0 5px 1px #6500ff;background: #6500ff;position: relative;">
                            <h3><i class="circular image icon"></i>Change Avatar</h3>
                        </div>
                    </label>
                </a>

                <a href="#" onclick="$('#file-banner').trigger('click')">
                    <form id="banner-change" method="post" style="display:none" action="<?= $_SERVER["REQUEST_URI"] ?>?type=banner" enctype="multipart/form-data" >
                        <input type="file" id="file-banner" required accept="image/*" name="file" onchange="$('#banner-change').submit()">
                    </form>
                    <label style="display:block" for="file-banner" class="hoverable tab">
                        <div class="label" style="box-shadow: 0 0 5px 1px #6500ff;background: #6500ff;position: relative;">
                            <h3><i class="circular image icon"></i>Change Banner</h3>
                        </div>
                    </label>
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
             
    <script>
        function changeAvatar(e) {

        }

        function changeBanner(e) {
            
        }
    </script>   
    

<?php GenerateFooter(); ?>