<?php


namespace framework;

use models\NotFoundResponse;
use models\ValidationError;
use services\SessionService;

/**
 * A base for other controllers to implement and expand on
 * @package framework
 */
abstract class ControllerBase
{
    /**
     * @var SessionService
     */
    protected $sessionService;

    /**
     * ControllerBase constructor.
     * @param SessionService $sessionService
     */
    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    public function __toString()
    {
        return static::class;
    }

    protected function Ok($response): ActionResult
    {
        return new ActionResult($response, 200);
    }

    protected function NotFound(): ActionResult
    {
        return new ActionResult(new NotFoundResponse(), 404);
    }

    protected function BadRequest($response): ActionResult
    {
        return new ActionResult($response, 400);
    }

    protected function NoContent(): ActionResult
    {
        return new ActionResult(null, 204);
    }

    /**
     * Call to manually handle the network response
     *
     * @return ActionResult
     */
    protected function ManuallyHandled(): ActionResult
    {
        return new ActionResult(null, -1);
    }

    /**
     * Returns an action result if the user is not authenticated
     */
    protected function required_authentication()
    {
        if ($this->sessionService->get_active_user_id()) {
            return null;
        }
        return new ActionResult(new ValidationError("Not Authenticated"), 401);
    }
}