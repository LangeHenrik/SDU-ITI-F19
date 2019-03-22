<?php


namespace controllers;


use framework\ActionResult;
use framework\ControllerBase;
use services\ImageService;
use services\SessionService;

class ImageController extends ControllerBase
{
    /**
     * @var ImageService
     */
    private $imageService;

    public function __construct(ImageService $imageService, SessionService $sessionService)
    {
        parent::__construct($sessionService);
        $this->imageService = $imageService;
    }

    public function get(int $query_id): ActionResult
    {
        if ($authentication_required = $this->required_authentication()) {
            return $authentication_required;
        }

        if ($this->imageService->print_image($query_id)) {
            return $this->ManuallyHandled();
        } else {
            return $this->NotFound();
        }
    }
}