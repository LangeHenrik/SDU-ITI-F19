<?php
namespace Controllers;

use DependencyInjector\DependencyInjectionContainer;
use Models\Dto\PhotoDto;
use Repositories\Interfaces\IPhotoRepository;
use Repositories\Interfaces\IUserRepository;
use Routing\IRequest;
use Services\Auth;

class PhotoController extends BaseController
{

    /**
     * @var IPhotoRepository;
     */
    private $photoRepository;

    /**
     * @var IUserRepository
     */
    private $userRepository;

    /**
     * PhotoController constructor.
     * @param DependencyInjectionContainer $di
     * @param $config
     */
    public function __construct(DependencyInjectionContainer $di, $config)
    {
        parent::__construct($config);
        $this->photoRepository = $di->get(IPhotoRepository::class);
        $this->userRepository = $di->get(IUserRepository::class);
    }

    public function index(IRequest $request)
    {
        return $this->html("photos", ["page_title" => "All photos", "photos" => $this->photoRepository->getAll()]);
    }

    public function deletePhoto(IRequest $request)
    {
        $imgId = $request->getBody()["id"];
        $photoToDelete = $this->photoRepository->getById($imgId);
        $loggedInUser = $this->userRepository->getByUsername(Auth::getLoggedinUsername());

        $success = false;
        if ($photoToDelete->author->id === $loggedInUser->id) {
            $success = $this->photoRepository->deletePhoto($photoToDelete->id);
        }

        return $this->json(["success" => $success]);
    }

    public function uploadPhoto(IRequest $request)
    {
        $body = $request->getBody();

        $title = $body["title"];
        $caption = $body["caption"];

        $error = $this->validatePhoto($body);
        if ($error !== -1000) {
            $this->redirect("/profile?error=".$error);
        }

        $ext = pathinfo($body["_FILES"]["image"]["name"], PATHINFO_EXTENSION);
        $imgName = hash("sha256", $body["_FILES"]["image"]["name"].$body["_FILES"]["image"]["size"].time()) . "." . $ext;

        $user = $this->userRepository->getByUsername(Auth::getLoggedinUsername());

        $this->photoRepository->addPhoto(new PhotoDto($title, $caption, $imgName, $user->id));

        $targetFile = $this->config["app_upload_dir"] . $imgName;

        move_uploaded_file($body["_FILES"]["image"]["tmp_name"], $targetFile);

        $this->redirect("/profile");
    }

    private function validatePhoto($body) {
        if ($body["_FILES"]["image"]["error"] > 0) {
            $error = $body["_FILES"]["image"]["error"];
            return $error;
        }
        else if (!in_array($body["_FILES"]["image"]["type"], ["image/jpg", "image/jpeg", "image/png"])) {
            return -1;
        }

        return -1000;

    }
}