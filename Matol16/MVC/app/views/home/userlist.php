<?php include '../app/views/home/header.php'; ?>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

<a href="../picture/getall">
    <input type="submit" value="Go Back""/>
</a>
<br/>
<table style="width:40%">
    <tr>
        <th>ID</th>
        <th>Username</th>
    </tr>
    <?php
foreach($data['users'] as $user) :
?>
    <tr>
        <th><ph><?=$user['ID']?></ph></th>
        <th><ph><?=$user['username']?></ph></th>
    </tr>

<?php
endforeach;
?>
</table>