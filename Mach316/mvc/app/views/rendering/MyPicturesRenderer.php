<?php

class MyPicturesRenderer
{


    public function renderMyPictures($images)
    {
        $renderString = "<div class='user-management-pictures'>";
        if ($images != null) {
            foreach ($images as $image) {
                $renderString .= $this->renderMyPicture($image);
            }
            $renderString .= "</div>";
        }
        return $renderString;

    }

    private function renderMyPicture($image)
    {
        $imagePath = "/Mach316/mvc/app/uploads/" . $image->getFilename();
        $imageID = $image->getId();
        $renderString = "    
                         <div class='user-management-picture'>
                            <img src=$imagePath class='user-management-image'/>
                                <form method='post' action='deleteImage'>
                                    <input type='submit' value='Delete'>
                                    <input type='hidden' name='imageID' value=$imageID/>
                                </form>
                         </div>";

        return $renderString;

    }

}
