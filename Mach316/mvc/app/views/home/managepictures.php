<?php include '../app/views/partials/navigationbar.php';
echo "<link rel='stylesheet' href='/Mach316/mvc/public/css/general.css'>";
echo "<link rel='stylesheet' href='/Mach316/mvc/public/css/myimages.css'>";


echo "<h1>Manage Pictures!</h1>";


$formaction = '/Mach316/mvc/public/api/pictures/user/' . $_SESSION['userid'];
$images = $parameters['images'];

echo "
        <form class='upload-image-form' action=$formaction method='post' enctype='multipart/form-data'>
           
            <div><div>Image title</div><input type='text' name='header' /></div>
            <div><div>Image text</div><textarea rows='10' cols='100' name='text'></textarea></div>
            <div> Select image to upload:</div>
            <input type='file' name='fileToUpload' id='fileToUpload'>
            <input type='submit' value='Upload Image' name='submit'>
        </form>
     ";

$myPicturesRenderer = new MyPicturesRenderer();
$myPictures = $myPicturesRenderer->renderMyPictures($images);
echo $myPictures;
