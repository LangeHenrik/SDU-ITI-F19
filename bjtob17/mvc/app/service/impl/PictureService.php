<?php


namespace app\service\impl;


use app\model\dto\PictureDto;
use app\repository\IPictureRepository;
use app\service\IEntityService;
use app\service\IPictureService;

class PictureService implements IPictureService
{
    /**
     * @var IPictureRepository
     */
    private $pictureRepository;

    /**
     * @var IEntityService
     */
    private $entityService;

    /**
     * PictureService constructor.
     * @param IPictureRepository $pictureRepository
     * @param IEntityService $entityService
     */
    public function __construct(IPictureRepository $pictureRepository, IEntityService $entityService)
    {
        $this->pictureRepository = $pictureRepository;
        $this->entityService = $entityService;
    }


    function findAll(): array
    {
        // TODO: Implement findAll() method.
        return $this->entityService->formatMultiple($this->pictureRepository->findAll());
    }

    function findByUserId(int $userId): array
    {
        // TODO: Implement findByUserId() method.
        return $this->entityService->formatMultiple($this->pictureRepository->findByUserId($userId));
    }

    function uploadImage(PictureDto $pictureDto): bool
    {
        return $this->pictureRepository->uploadPicture($pictureDto->image, $pictureDto->title, $pictureDto->description);
    }
}