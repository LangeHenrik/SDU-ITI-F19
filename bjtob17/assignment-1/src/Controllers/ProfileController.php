<?php

namespace Controllers;


use DependencyInjector\DependencyInjectionContainer;
use Repositories\Interfaces\IPhotoRepository;
use Routing\IRequest;
use Services\Auth;

class ProfileController extends BaseController
{
    /**
     * @var IPhotoRepository
     */
    private $photoRepository;

    /**
     * IndexController constructor.
     * @param DependencyInjectionContainer $di
     * @param $config
     */
    public function __construct(DependencyInjectionContainer $di, $config)
    {
        parent::__construct($config);

        $this->photoRepository = $di->get(IPhotoRepository::class);
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
        return $this->html("profile", ["_errors" => $errors, "page_title" => "Profile", "photos" => $this->photoRepository->getPhotoForUser(Auth::getLoggedinUsername())]);
    }
}