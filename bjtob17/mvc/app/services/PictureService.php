<?php


namespace app\services;


use app\repositories\IOtherRepository;
use app\repositories\IPictureRepository;

class PictureService implements IPictureService
{
    /**
     * @var IPictureRepository
     */
    private $pictureRepository;

    /**
     * PictureService constructor.
     * @param IPictureRepository $pictureRepository
     * @param IOtherRepository $otherRepository
     */
    public function __construct(IPictureRepository $pictureRepository, IOtherRepository $otherRepository)
    {
        $this->pictureRepository = $pictureRepository;
    }


    function uploadImage($image): int
    {
        // TODO: Implement uploadImage() method.
        return 1;
    }
}