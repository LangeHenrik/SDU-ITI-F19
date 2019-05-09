<?php
class Alert {
    
    public function message($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }
}