<?php

header('Location: ../index_new.php'); //send them back to the index

session_start();
session_unset(); //delete all session variables
session_destroy(); //destoyes the session variables
