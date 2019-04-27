<?php


namespace app\controller;


use app\service\IPictureService;
use app\service\IUserService;
use app\util\AuthUtil;
use framework\controller\BaseController;
use framework\response\IResponse;
use framework\routing\IRequest;

class PictureController extends BaseController
{

    /**
     * @var IPictureService
     */
    private $pictureService;

    /**
     * @var IUserService
     */
    private $userService;

    /**
     * PictureController constructor.
     * @param IPictureService $pictureService
     * @param IUserService $userService
     */
    public function __construct(IPictureService $pictureService, IUserService $userService)
    {
        $this->pictureService = $pictureService;
        $this->userService = $userService;
    }

    public function uploadPictureOld(IRequest $request): IResponse
    {
        $body = $request->getBody();
        $this->pictureService->uploadPictureForm($body);

        $this->redirect("/profile");
    }

    public function getAllPictures(IRequest $request): IResponse
    {
        return $this->html("/pictures", [
            "page_title" => "All images",
            "photos" => $this->pictureService->findAll()
        ]);
    }

    public function getImagesForUser(IRequest $request, int $userId): IResponse
    {
        return $this->json($this->pictureService->findByUserId($userId));
    }

    public function uploadImage(IRequest $request, int $userId): IResponse
    {
        return $this->json($request->getBodyAsJson("json"));
        /**
         * $pictureDtoArr = $request->getBody();
         * $pictureDtoArr["userId"] = $userId;
         *
         * $success = $this->pictureService->uploadImage(PictureDto::fromArray($pictureDtoArr));
         * return $this->json(["success" => $success], $success ? 200 : 500);*/
    }

}