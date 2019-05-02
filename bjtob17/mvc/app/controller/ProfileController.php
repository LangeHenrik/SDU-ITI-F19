<?php


namespace app\controller;


use app\service\IPictureService;
use app\util\AuthUtil;
use framework\controller\BaseController;
use framework\routing\IRequest;

class ProfileController extends BaseController
{
    /**
     * @var IPictureService
     */
    private $pictureService;

    /**
     * ProfileController constructor.
     * @param IPictureService $pictureService
     */
    public function __construct(IPictureService $pictureService)
    {
        $this->pictureService = $pictureService;
    }

    public function index(IRequest $request)
    {
        $errors = [];
        $phpFileUploadErrors = array(
            -1 => "Only images must be uploaded",
            1 => 'Image may not be larger than 2MB',
            2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
            3 => 'The uploaded file was only partially uploaded',
            4 => 'No file was uploaded',
            6 => 'Missing a temporary folder',
            7 => 'Failed to write file to disk.',
            8 => 'A PHP extension stopped the file upload.',
        );
        if (isset($request->getBody()["error"]) && isset($phpFileUploadErrors[$request->getBody()["error"]])) {
            $message = $phpFileUploadErrors[$request->getBody()["error"]];
            $errors = [$message];
        }
        return $this->html("profile", [
            "_errors" => $errors,
            "page_title" => "Profile",
            "photos" => $this->pictureService->getPicturesForUser(AuthUtil::getLoggedinUsername()),
            "photo_action" =>  $_SERVER["route_offset"] . "/pictures"
        ]);

    }


}