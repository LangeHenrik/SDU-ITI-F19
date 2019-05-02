<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 29-04-2019
 */


session_start();

session_destroy();

header("location: ../View/index.php");