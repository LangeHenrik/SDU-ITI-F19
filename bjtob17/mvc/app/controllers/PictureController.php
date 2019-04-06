<?php


namespace app\controllers;


use app\services\IPictureService;
use framework\controllers\BaseController;
use framework\dependencyInjection\DependencyInjectionContainer;
use framework\responses\IResponse;
use framework\routing\IRequest;

class PictureController extends BaseController
{

    /**
     * @var IPictureService
     */
    private $pictureService;

    /**
     * PictureController constructor.
     * @param array $config
     * @param DependencyInjectionContainer $di
     */
    public function __construct(array $config, DependencyInjectionContainer $di)
    {
        parent::__construct($config, $di);
        $this->pictureService = $di->get(IPictureService::class);
    }


    public function getImagesForUser(IRequest $request, int $userId): IResponse
    {
        return $this->json([
            [
                "image_id" => $userId,
                "title" => "title",
                "description" => "description",
                "image" => "image.jpg"
            ]
        ]);
    }

    public function uploadImage(IRequest $request, int $userId): IResponse
    {
        $imageDto = $request->getBody();

    }


}