<?php
class Alert {
    public static function message($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';

    }
}