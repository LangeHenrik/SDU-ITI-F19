<?php


namespace controllers;


use framework\ActionResult;
use framework\ControllerBase;
use services\ImageService;

class ImageController extends ControllerBase
{
    /**
     * @var ImageService
     */
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function get(int $query_id): ActionResult
    {
        if ($this->imageService->print_image($query_id)) {
            return $this->ManuallyHandled();
        } else {
            return $this->NotFound();
        }
    }
}