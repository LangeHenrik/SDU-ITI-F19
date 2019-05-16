<?php
include '../app/views/home/header.php';
?>

    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <a href="upload">
        <input type="submit" value="Upload a Picture"/>
    </a>
    <br>
    <a href="../user/UserList">
        <input type="submit" value="User List""/>
    </a>
    <form method="POST" action="/mvc/public/home/logout">
        <input type="submit" value="Log Out"/>
    </form>



<?php
foreach($data['pictures'] as $picture) :
    ?>
    <div id="aniBox">
        <h1><?=$picture['header']?></h1>
        <img src="<?=$picture['picturelink']?>" alt="<?=$picture['header']?>" id="aniImg"/>
        <p><?=$picture['description']?></p>
        <br/>
    </div>

<?php
endforeach;