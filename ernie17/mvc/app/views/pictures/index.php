<?php include '../app/views/partials/head.php'; ?>

<?php include '../app/views/partials/header.php'; ?>

<div class="block-pictures">
    <?php
        foreach ($viewbag['pictures'] as $picture) {
            echo "<div class='picture'>";
                $pictureUserId = $picture['picture_user_id'];
                $imageName = $picture['image_name'];
                $header = $picture['header'];
                $description = $picture['description'];

                // $imageNameExploded = explode ('-', $imageName);
                // $date = date('d-m-Y H:i', current($imageNameExploded));

                foreach ($viewbag['users'] as $user) {
                    if ($user["picture_user_id"] === $viewbag['user']['userId']) {
                        $pictureAuthor = $user["firstname"] . " " . $user["lastname"];
                    }
                }

                echo "<p class='header'>$header</p>";
                echo "<img src='$imageName'>";
                echo "<p class='description'>$description (User: $pictureAuthor)</p>";
                // echo "<p class='date'>Uploaded: $date</p>";
                echo "<hr>";
            echo "</div>";
        }
    ?>
</div>

<?php include '../app/views/partials/footer.php'; ?>

<?php include '../app/views/partials/foot.php'; ?>
