<?php

use Models\Photo;

class PhotoPartial
{
    public static function show(Photo $photo)
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
        <img src="$photo->imgName" alt="">
    </div>
    <div class="text">
        <p class="caption">$photo->caption</p>
    </div>
    <span class="date">$date</span>
</article>
</div>
EOL;

    }
}