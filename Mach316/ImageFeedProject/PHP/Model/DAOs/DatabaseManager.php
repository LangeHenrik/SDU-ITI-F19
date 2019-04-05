<?php
/**
 * Created by PhpStorm.
 * User: MadsNorby
 * Date: 2019-03-12
 * Time: 18:50
 */

require_once 'db_config.php';
require_once 'UserDAO.php';
require_once 'CommentDAO.php';
require_once 'ImageDAO.php';
require_once 'DAO.php';

session_start();

class DatabaseManager
{


    private $userDAO;
    private $imageDAO;
    private $commentDAO;

    public final function __construct()
    {
        if ($this->userDAO == null) {
            $this->userDAO = new UserDAO();
        }
        if ($this->commentDAO == null) {
            $this->commentDAO = new CommentDAO();
        }
        if ($this->imageDAO == null) {
            $this->imageDAO = new ImageDAO();
        }
    }


    //--- All image access functions --//

    function getAllImages()
    {
        return $this->imageDAO->getAllImages();
    }

    function getUserImages()
    {
        return $this->imageDAO->getUserImages();
    }

    function getUserImagesById($userId)
    {
        return $this->imageDAO->getUserImagesById($userId);
    }


    //-- All comment access functions --//

    function getImageComments($imageId)
    {
        return $this->commentDAO->getImageComments($imageId);
    }

    function addImageComment($comment)
    {
        return $this->commentDAO->addImageComment($comment);
    }


    //-- All user access functions --//


    function getUserName($id)
    {
        return $this->userDAO->getUserName($id);
    }

    function getCurrentUser()
    {
        return $this->userDAO->getCurrentUser();
    }

    function getAllUsers()
    {
        return $this->userDAO->getAllUsers();
    }

    function searchUsers($nameSearch)
    {
        return $this->userDAO->searchUsers($nameSearch);
    }

    function registerUser($user)
    {
        return $this->userDAO->registerUser($user);
    }

}

