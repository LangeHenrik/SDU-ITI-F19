<?php
/**
 * Created by PhpStorm.
 * User: Jesper
 * Date: 15-03-2019
 * Time: 07:25
 */

session_start();

session_destroy();

header("location: ../View/index.php");