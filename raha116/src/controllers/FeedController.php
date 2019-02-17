<?php


namespace controllers;


use framework\ActionResult;
use framework\ControllerBase;
use framework\JsonConverter;
use models\CreateFeedEntryRequest;
use models\UploadedFile;
use models\ValidationError;
use services\FeedService;
use services\SessionService;

class FeedController extends ControllerBase
{

    /**
     * @var FeedService
     */
    private $feedService;

    /**
     * FeedController constructor.
     * @param FeedService $feedService
     * @param SessionService $sessionService
     */
    public function __construct(FeedService $feedService, SessionService $sessionService)
    {
        parent::__construct($sessionService);
        $this->feedService = $feedService;
    }


    public function get(): ActionResult
    {
        if ($authentication_required = $this->required_authentication()) {
            return $authentication_required;
        }

        $entries = $this->feedService->get_feed();

        return $this->Ok($entries);
    }

    public function post(CreateFeedEntryRequest $body): ActionResult
    {
        if ($authentication_required = $this->required_authentication()) {
            return $authentication_required;
        }

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
        return $this->NoContent();
    }
}