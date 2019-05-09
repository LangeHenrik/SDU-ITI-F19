<link rel="stylesheet" type="text/css" href="/pepak16/mvc/app/views/style/style.css">

<!-- <script src="ajax.js"></script> -->

<div id="headertitle"><h1>Photoshare</h1></div>

<?php
    include_once $_SERVER["DOCUMENT_ROOT"].'/pepak16/mvc/app/controllers/HomeController.php';
    if (session_status() == PHP_SESSION_NONE ) {
        session_start();
        // echo 'session started';
    }
    // else {
    //     // echo 'session is already started';
    // }
    $homecontroller = new HomeController();
    if (isset($_GET['option'])) {
        //echo $_GET['option'];
        $homecontroller->changeMenuOptionTo($_GET['option']);
    }
    include $_SERVER["DOCUMENT_ROOT"].'/pepak16/mvc/app/views/partials/menu.php';
?>


