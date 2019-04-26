<!DOCTYPE html>
<html>
  <head>
    <title>My Awesome Website</title>
    <meta charset="UTF-8" />
    <meta name="HandheldFriendly" content="true">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width, user-scalable=no">
    <!-- <link href="main.css" rel="stylesheet"> -->
    <script type="text/javascript" src="/jahen19/mvc/public/script.js"></script>
  </head>
<body>
     <?php include '../app/views/partials/header.php'; ?>

    <section id="form-wrapper">
        <form id="fileform" action="return false;">
            <div class="row">
                <div class="col grid_1_of_3 right">
                    Select picture:
                </div>
                <div class="col grid_2_of_3">
                    <input type="file" name="file" autocomplete="off" required>
                </div>
            </div>
            <div class="row">
                <div class="col grid_1_of_3 right">
                    Header:
                </div>
                <div class="col grid_2_of_3">
                    <input type="text" name="header" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="col grid_1_of_3 right">
                    Subtext:
                </div>
                <div class="col grid_2_of_3">
                    <textarea name="subtext" autocomplete="off"></textarea>
                </div>
            </div>
            <div class="row" id="submit-wrapper">
                <input id="input-button" type="button" name="submit" value="Upload" onclick="send(); return false;">
            </div>
        </form>
    </section>

    <main id='feed'>
        <?php
        if ($viewbag['notloggedin'] == true) {
            echo "You need to log in first.<br>";
            return;
        }
        foreach( (array) $viewbag as $i) {
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
</body>
</html>
