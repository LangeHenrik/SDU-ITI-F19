<?php


namespace app\controller;


use app\service\IPictureService;
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
     * PictureController constructor.
     * @param IPictureService $pictureService
     */
    public function __construct(IPictureService $pictureService)
    {
        $this->pictureService = $pictureService;
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