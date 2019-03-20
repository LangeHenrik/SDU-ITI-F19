<?php
require_once("class/loadall.php");
$function->enforceLogin();
$function->getMenu();
$function->getHeadline("Velkommen til Forsiden");
$function->drawLeft();
$function->drawMain('index');
$function->drawRight();
?>

