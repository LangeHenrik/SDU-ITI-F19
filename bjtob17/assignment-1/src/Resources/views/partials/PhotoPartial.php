<?php

namespace Resources\views\partials;
use Models\Photo;

class PhotoPartial
{
    public static function show(Photo $photo, bool $showDelete = false)
    {
        $date = $photo->formatDate();
        $username = $photo->author->username;
        echo <<<EOL
<div class="card">
<article>
    <div class="author">
        <img src="https://robohash.org/$username" alt="">
        <p>$username</p>
    </div>
    <div class="image">
        <img src="/Resources/img/$photo->imgName" alt="">
    </div>
    <div class="text">
        <h4 class="title">$photo->title</h4>
        <p class="caption">$photo->caption</p>
    </div>
    <span class="date">$date</span>
EOL;
    if ($showDelete) {
        echo '<button onclick="deletePhoto(' . $photo->id . ')"><i class="fas fa-trash-alt"></i></button>';
    }
        echo '
</article>
</div>';

    }
}