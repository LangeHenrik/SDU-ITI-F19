<?php


namespace app\controller;


use framework\controller\BaseController;
use framework\response\IResponse;
use framework\routing\IRequest;

class PictureController extends BaseController
{

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