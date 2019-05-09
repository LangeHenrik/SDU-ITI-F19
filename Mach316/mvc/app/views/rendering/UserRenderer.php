<?php


class UserRenderer
{
    public function renderUsers($users)
    {

        $usersElement = "<div class='users'>";
        $count = 0;
        if ($users) {
            foreach ($users as $user) {
                $even = true;
                if ($count % 2 == 0) {
                    $even = true;
                } else {
                    $even = false;
                }
                $usersElement .= $this->renderUser($user, $even);
                $count = $count + 1;
            }
            $usersElement .= "</div>";
            return $usersElement;
        }
        else {
            return "<div>No users have registered yet</div>";
        }

    }

    public function renderUser($user, $even)
    {
        if ($even) {
            $classname = "user-even";
        } else {
            $classname = "user-odd";
        }

        $username = $user->getUsername();
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $userimages = $user->getImages();
        $imageElements = $this->renderUserImages($userimages);
        $userLink = '/Mach316/mvc/public/home/userpage/' . $username;

        $userElement = "
        <div class=$classname>
            <h2 class='user-username'><a href=$userLink>$username</a></h2>
            <h3 class='user-fullname'>$firstname $lastname</h3>
            <div class='user-images-wrapper'>$imageElements</div>
        </div>";

        return $userElement;

    }

    public function renderUserImages($userImages)
    {

        $userImagesElement = "<div class='user-images'>";
        if ($userImages) {
            foreach ($userImages as $userImage) {
                $filePath = $userImage->getFileName();
                $userImagesElement .= "<div class='user-image-wrapper'><img class='user-image' src=$filePath /></div>";
            }
        }
        $userImagesElement .= "</div>";

        return $userImagesElement;

    }


}