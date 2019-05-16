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
<br/>
<div id="frm">
    <form method="POST" action="/mvc/public/picture/uploadPic" >
        <label>Title of the picture:</label>
        <br/>
        <input type="text" name="header" />
        <br/>

        <label>Description of the picture:</label>
        <br/>
        <input type="text" name="desc""/>
        <br/>

        <label>Link to the Picture:</label>
        <br/>
        <input type="text" name="link"/>
        <br/>


        <br/>
        <input type="submit" class="btn btn-primary" value="Register">

        <br/>
    </form>
    <a href="../picture/getall">
        <input type="submit" value="Nevermind""/>
    </a>

    <br/>
    <br/>
</div>
