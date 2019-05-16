<?php
session_start();
session_destroy();

header('location: iFrame.php'); exit;

?>