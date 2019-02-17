<?php


namespace controllers;


use framework\ActionResult;
use framework\ControllerBase;
use framework\JsonConverter;
use models\CreateFeedEntryRequest;
use models\UploadedFile;
use models\ValidationError;
use services\FeedService;

class FeedController extends ControllerBase
{

    /**
     * @var FeedService
     */
    private $feedService;

    /**
     * FeedController constructor.
     * @param FeedService $feedService
     */
    public function __construct(FeedService $feedService)
    {
        $this->feedService = $feedService;
    }


    public function get(): ActionResult
    {

    }

    public function post(CreateFeedEntryRequest $body): ActionResult
    {
        $error = $body->validate();

        if ($error) {
            return $this->BadRequest(new ValidationError($error));
        }

        $image = JsonConverter::convert_to_object($body->image, UploadedFile::class);

        $result = $this->feedService->create_feed_entry($body->title, $body->description, $image);

        return $this->Ok($result);
    }

    public function delete(): ActionResult
    {

    }
}