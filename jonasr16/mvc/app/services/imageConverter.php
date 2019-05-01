<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 01-05-2019
 * Time: 13:39
 */

namespace services;
class imageConverter
{
    public function convertArray(array $imageArray){
        $newArray = $imageArray;
        for ($x = 0; $x < sizeof($imageArray); $x++) {
            if($imageArray[$x]['extension'] === "string"){
                $newArray[$x]['imageString'] = $imageArray[$x]['image'];
            } else {
                $currentImage = $imageArray[$x]['image'];
                $currentType = $imageArray[$x]['extension'];
                $data = $this->convert($currentImage, $currentType);
                $newArray[$x]['imageString'] = 'data:' .  $newArray[$x]['extension'] .  ';base64,' .  base64_encode($data);
            }
        }
        return $newArray;
    }

    public function convert($imageFile, $type){
        $image = imagecreatefromstring(base64_decode($imageFile));
        ob_start();
        if($type == "image/jpeg"){
            imagejpeg($image, null, -1);
        } else if($type == "image/png"){
            imagepng($image, null, -1);
        }
        $data = ob_get_contents();
        ob_end_clean();
        return $data;
    }
}