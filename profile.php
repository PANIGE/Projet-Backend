<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/generalHelper.php");
    require_once("./php/sql.php");
    

    $ID = $_GET["id"];
    $User = GetUserData($ID);
    GenerateHeader("../../banners/".$ID, "User Profile");
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
                           <h1 class="username"><?= $User["username"] ?></h1>
                           
                           <h1 style="
                           margin: 0;
                           color: #ff0;
                           text-shadow: 0 0 6px black;
                              ">Ultraverse</h1>                     
                        </div>
                     </div>
                  </div>
                  
                  <div class="p-avatar">
                    
                        <img height="256" alt="avatar" src="/avatars/<?= $ID ?>">
                        
                </div>
               </div>
            </div>
            
            <div class="profile-segment">
                <div class="left-panel">
                    
                    </div>
            
                
                <div class="right-panel">
                    <div class="ui raised segment">
                        
                        <div class="tab">
                            <div class="label" style="box-shadow: 0 0 5px 1px #2558ff;background: #2558ff;position: relative;">
                                <h3><i class="circular icon sign in icon"></i><time class="timeago" datetime="2020-04-18T16:09:04+02:00" title="2020-04-18 16:09:04 +0200 DST">about a year ago</time></h3>
                            </div>
                        </div>
                        <div class="tab">
                            <div class="label" style="box-shadow: 0 0 5px 1px #47ffe8;background: #47ffe8;position: relative;">
                                <h3><i class="circular icon power icon"></i><time class="timeago" datetime="2021-06-13T16:58:42+02:00" title="2021-06-13 16:58:42 +0200 DST">about 22 hours ago</time></h3>
                            </div>
                        </div>
        
                        <div class="ui divider"></div>
            
                        
                        
                        
                        <div class="tab">
                            <div class="label" style="box-shadow: 0 0 5px 1px #72ddff;background: #72ddff;position: relative;">
                                <h3><i class="circular blue code icon"></i>Developer</h3>
                            </div>
                        </div>
                        
                        <div class="tab">
                            <div class="label" style="box-shadow: 0 0 5px 1px #72ddff;background: #72ddff;position: relative;">
                                <h3><i class="circular legal  icon"></i>Admin</h3>
                            </div>
                        </div>
                        
                        <div class="tab">
                            <div class="label" style="box-shadow: 0 0 5px 1px #72ddff;background: #72ddff;position: relative;">
                                <h3><i class="circular globe  icon"></i>Owner</h3>
                            </div>
                        </div>
                        
                        <div class="tab">
                            <div class="label" style="box-shadow: 0 0 5px 1px #72ddff;background: #72ddff;position: relative;">
                                <h3><i class="circular paint brush violet icon"></i>Designer</h3>
                            </div>
                        </div>
                        
                        <div class="tab">
                            <div class="label" style="box-shadow: 0 0 5px 1px #72ddff;background: #72ddff;position: relative;">
                                <h3><i class="circular check mark icon"></i>Certified</h3>
                            </div>
                        </div>
                        
                      </div>
                </div>
             </div>
             
             
    

<?php GenerateFooter(); ?>