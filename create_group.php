<?php 
    require_once("./php/htmlHelper.php");
    require_once("./php/sql.php");
    $pdo = getpdo();
    require_once("./php/generalHelper.php");
    GenerateHeader("register.jpg", "Create Group");

    $ID = GetId();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Name    = filter_input(INPUT_POST, "groupname");
        $private = filter_input(INPUT_POST, "private");
        if($Name && ($private >= 0 && $private <= 1)){
            $test_name = $pdo->prepare('SELECT name FROM groups where name = :name');
            $test_name->execute([
                ":name" => $Name
            ]);
            $t_name = $test_name->fetchAll(PDO::FETCH_ASSOC);
            $OK = $test_name->rowCount() > 0; 
            if (!$OK) {
                $c_group = $pdo->prepare("INSERT INTO groups (name, is_private) value(:Name, :private)");
                $c_group->execute([
                    ":Name"    => $Name,
                    ":private" => $private,
                ]);
                $create_group = $c_group->fetchALL();
                $GID = $pdo->prepare("SELECT ID FROM groups WHERE name = :name");
                $GID->execute([
                    ":name" => $Name,
                ]);
                $group_id = $GID->setFetchMode(PDO::FETCH_ASSOC);
                $join_group = $pdo->prepare("INSERT INTO user_groups (GID, UID, rank, pending) value(:GID, :UID, 1, 0)");
                $join_group->execute([
                    ":GID"      => $group_id,
                    ":UID"      => $ID,
                ]);
                header('location:/groups/'.$group_id);
            }
            else{
                $GID = $pdo->prepare("SELECT ID FROM groups WHERE name = :test");
                $GID->execute([
                    ':test' => 'test'
                ]);
                $group_id = $GID->setFetchMode(PDO::FETCH_ASSOC);
                echo '<script> alert('.$group_id.');</script>';
            }
        }
    }
?>
<div class="ui container">

<div class="tiny container">
    <div class="ui raised segments">
        <div class="ui segment">
            <form id="group-form" class="ui form" method="post" action="/create_group.php">
                <div class="field">
                    <label>Group name (2 to 15 characters, alphanumeric, spaces, <code>_[]-</code>)</label>
                    <input tabindex="1" type="text" name="groupname" placeholder="Group name"" required pattern="^[A-Za-z0-9 _\[\]-]{2,15}$">
                </div>
                <div class="field">
                    <label>Do you want a public or a private group ?</label>
                    <input type="radio" name="private" id="public" name="fav_language" value=0>    Public   </input>
                    <input type="radio" name="private" id="private" name="fav_language" value=1>   Private  </input>
                </div>

            </form>
        </div>
        <div class="ui right aligned segment">
            <button tabindex="3" class="ui primary button" type="submit" form="group-form">Submit</button>
        </div>
    </div>
</div>

</div>

<?php GenerateFooter(); ?>
