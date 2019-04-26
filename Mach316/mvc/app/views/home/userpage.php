<?php include '../app/views/partials/navigationbar.php';
echo "<link rel='stylesheet' href='/Mach316/mvc/public/css/general.css'>";
echo "<link rel='stylesheet' href='/Mach316/mvc/public/css/userpage.css'>";



$user = $parameters['user'];
$username = $user->getUsername();
$images = $parameters['images'];

?>
<div class="main-content">
<?php
echo "<h1>Welcome to $username's page</h1>";


if($images != null) {
    foreach ($images as $image) {
        $fileName = $image->getFileName();
        $imageHeader = $image->getHeader();
        $imagePath = "/Mach316/mvc/app/uploads/".$fileName;
        echo "
                <div class='userpage-image-wrapper'>
                    <div class='userpage-image-header'>
                        $imageHeader
                    </div>
                    <img class='userpage-image' src=$imagePath />
                </div>";
    }
} else {
    echo "This user has no images";
}
?>
</div>

