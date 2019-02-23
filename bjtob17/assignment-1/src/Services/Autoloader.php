<?php
namespace Services;
/**
 * Simple autoloader, so we don't need Composer just for this.
 * http://php.net/manual/en/language.oop5.autoload.php#120258
 */
class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
            $file = $_SERVER['DOCUMENT_ROOT'] . "/" . $file;
            if (file_exists($file)) {
                require $file;
                return true;
            }
            return false;
        });
    }
}
Autoloader::register();