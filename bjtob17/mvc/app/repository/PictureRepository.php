<?php


namespace app\repository;


class PictureRepository implements IPictureRepository
{
    private $otherRepo;

    /**
     * PictureRepository constructor.
     * @param IOtherRepository $otherRepo
     */
    public function __construct(IOtherRepository $otherRepo)
    {
        $this->otherRepo = $otherRepo;
    }


}