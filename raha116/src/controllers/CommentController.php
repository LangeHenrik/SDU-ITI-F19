<?php


namespace controllers;


use framework\ActionResult;
use framework\ControllerBase;
use models\CreateCommentRequest;
use services\CommentService;
use services\SessionService;

class CommentController extends ControllerBase
{
    /**
     * @var CommentService
     */
    private $comment_service;

    /**
     * CommentController constructor.
     * @param CommentService $comment_service
     * @param SessionService $session_service
     */
    public function __construct(CommentService $comment_service, SessionService $session_service)
    {
        parent::__construct($session_service);
        $this->comment_service = $comment_service;
    }


    public function post(CreateCommentRequest $body): ActionResult
    {
        if ($result = $this->required_authentication()) {
            return $result;
        }

        if ($error = $body->validate()) {
            return $this->BadRequest($error);
        }

        $comment = $this->comment_service->create_comment($body->feedEntryId, $body->text);

        return $this->Ok($comment);
    }
}