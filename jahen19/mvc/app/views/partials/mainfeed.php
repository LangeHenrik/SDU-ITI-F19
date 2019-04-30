<main id='feed' class="mx-auto">
<?php
if ($viewbag['notloggedin'] == true) {
    echo "You need to log in first.<br>";
    return;
}
foreach( (array) $viewbag['images'] as $i) {
    ?>
    <div class="container mw-90 justify-content-center">
    <figure id="<?php echo $i->id; ?>" class="figure">
    <!-- htmlspecialchars() avoids XSS attacks etc., see http://php.net/manual/en/function.htmlspecialchars.php -->
    <figcaption class="figure-caption text-center font-weight-bold"><?php echo htmlspecialchars($i->header); ?></figcaption>
    <img class="figure-img img-fluid rounded" src="<?php echo $i->data; ?>" >
    <blockquote class="text-monospace"><?php echo htmlspecialchars($i->text); ?></blockquote>
<?php if ($i->user == $_SESSION["username"]) { ?>
        <button class="delete-button" type="submit" onclick="deletePicture(this)" value="<?php echo $i->id; ?>">Delete</button>
<?php } ?>
    </figure>
    </div>
    <hr>
<?php
}
?>

</main>
