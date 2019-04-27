<?php


namespace app\service\impl;


use app\model\dto\PictureApiRequestDto;
use app\repository\IPictureRepository;
use app\repository\IUserRepository;
use app\service\IPictureService;
use app\util\AuthUtil;

class PictureService implements IPictureService
{
    /**
     * @var IPictureRepository
     */
    private $pictureRepository;


    /**
     * @var IUserRepository
     */
    private $userRepository;

    /**
     * PictureService constructor.
     * @param IPictureRepository $pictureRepository
     * @param IUserRepository $userRepository
     */
    public function __construct(IPictureRepository $pictureRepository, IUserRepository $userRepository)
    {
        $this->pictureRepository = $pictureRepository;
        $this->userRepository = $userRepository;
    }


    function findAll(int $limit = 999999999999999): array
    {
        return $this->pictureRepository->findAll($limit);
    }

    function findByUserId(int $userId): array
    {
        return $this->pictureRepository->findByUserId($userId);
    }

    function uploadImage(PictureApiRequestDto $picture): int
    {
        $user = $this->userRepository->findByUsername($picture->username);
        return $this->pictureRepository->uploadPicture(
            $picture->image, $picture->title, $picture->description, $user
        );
    }

    function uploadPictureForm(array $body)
    {
        $title = $body["title"];
        $caption = $body["caption"];
        $error = $this->validatePhoto($body);
        if ($error !== -1000) {
            $this->redirect("/profile?error=" . $error);
        }
        $user = $this->userRepository->findByUsername(AuthUtil::getLoggedinUsername());
        $imageData = file_get_contents($body["_FILES"]["image"]["tmp_name"]);
        $base64 = base64_encode($imageData);
        $this->pictureRepository->uploadPicture($base64, $title, $caption, $user);
    }

    function getPicturesForUser(string $username): array
    {
        $user = $this->userRepository->findByUsername($username);
        $pictures = $this->pictureRepository->findByUserId($user->user_id);
        return $pictures;
    }

    private function validatePhoto($body)
    {
        if ($body["_FILES"]["image"]["error"] > 0) {
            $error = $body["_FILES"]["image"]["error"];
            return $error;
        } else if (!in_array($body["_FILES"]["image"]["type"], ["image/jpg", "image/jpeg", "image/png"])) {
            return -1;
        }
        return -1000;
    }
}