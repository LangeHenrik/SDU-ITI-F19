<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-03-20
 * Time: 10:12
 */
session_start();
session_destroy();
header("location: Login.php");