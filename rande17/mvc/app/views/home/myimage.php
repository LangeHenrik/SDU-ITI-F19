<?php include '../app/views/partials/menu.php';
$box = new Box();
?>
    <form action='/mvc/public/home/home/upload' method='post' enctype='multipart/form-data'><input type='text'
                                                                                                   name='name'
                                                                                                   placeholder='imagename'><br/><input
                type='text' name='desc' placeholder='Image Description'><br/>Select image to upload:<input type='file'
                                                                                                           name='fileToUpload'
                                                                                                           id='fileToUpload'>
        <input type='submit' value='Upload Image' name='submit'></form>
<?php echo $box->getMainBox($viewbag, "image"); ?>