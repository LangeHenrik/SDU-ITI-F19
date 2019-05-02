<?php

    $page = 'home';
    Views\Core\Header::view($page);

?>

<div class="content">
    <div class="intro">
        <h1>Welcome to Photofyre</h1>
        <p>Sign up. View photos. Upload your own photos.</p>
    </div>
</div>

<?php

    Views\Core\Footer::view();

?>