<?php


namespace app\service;



use app\repository\IPictureRepository;

class PictureService implements IPictureService
{
    /**
     * @var IPictureRepository
     */
    private $pictureRepository;

    /**
     * PictureService constructor.
     * @param IPictureRepository $pictureRepository
     */
    public function __construct(IPictureRepository $pictureRepository)
    {
        $this->pictureRepository = $pictureRepository;
    }


    function uploadImage($image): int
    {
        // TODO: Implement uploadImage() method.
        return 1;
    }
}