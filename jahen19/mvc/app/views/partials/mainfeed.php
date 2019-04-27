<main id='feed'>
<?php
if ($viewbag['notloggedin'] == true) {
    echo "You need to log in first.<br>";
    return;
}
foreach( (array) $viewbag['images'] as $i) {
    ?>
    <figure id="<?php echo $i->id; ?>">
    <!-- htmlspecialchars() avoids XSS attacks etc., see http://php.net/manual/en/function.htmlspecialchars.php -->
    <figcaption><?php echo htmlspecialchars($i->header); ?></figcaption>
    <img src="data:image/jpg;base64, <?php echo $i->data; ?>">
    <blockquote><?php echo htmlspecialchars($i->text); ?></blockquote>
<?php if ($i->user == $_SESSION["username"]) { ?>
        <button class="delete-button" type="submit" onclick="deletePicture(this)" value="<?php echo $i->id; ?>">Delete</button>
<?php } ?>
    </figure>
<?php
}
?>

</main>
