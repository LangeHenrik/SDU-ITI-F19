<?php

namespace App\Core\Persistence\File;


class File
{

    /**
     * Get contents of file relative from the project root
     *
     * @param $path
     * @return false|string
     */
    public static function get($path) {
        return file_get_contents(__DIR__ . "/../../../../" . $path);
    }

    public static function save($file, $name) {
        // Abort if upload has errors
        if($file['error'] !== 0) {
            return false;
        }

        // Check if file is an image
        if(getimagesize($file['tmp_name']) !== false) {
            // Find file extension
            $ext = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));

            // Move file to upload folder
            $res = move_uploaded_file($file['tmp_name'], __DIR__ . "/../../../../public/uploads/{$name}.{$ext}");

            // Return filename
            return "{$name}.{$ext}";
        }
        return false;
    }

    public static function saveBase64($data, $name) {
        if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);

            // Find file extension and convert it to lowercase
            $ext = strtolower($type[1]);

            if (in_array($ext, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
                // Convert to image
                $image = base64_decode($data);

                // Save image to disk
                file_put_contents(__DIR__ . "/../../../../public/uploads/{$name}.{$ext}", $image);

                return "{$name}.{$ext}";
            }

            // File type is not valid (or allowed)
            return false;
        } else {
            // File is not an image
            return false;
        }
    }

}