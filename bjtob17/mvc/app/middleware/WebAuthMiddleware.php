<?php


namespace app\middleware;


use app\service\IAuthService;
use framework\middleware\AbstractMiddleware;
use framework\response\HtmlResponse;
use framework\routing\IRequest;

class WebAuthMiddleware extends AbstractMiddleware
{

    /**
     * @var IAuthService
     */
    private $authService;

    /**
     * WebAuthMiddleware constructor.
     * @param IAuthService $authService
     */
    public function __construct(IAuthService $authService)
    {
        $this->authService = $authService;
    }


    public function handle(IRequest $request): array
    {
        if ($this->authService->isLoggedInWeb()) {
            return $this->next($request);
        } else {
            return $this->fail($request, HtmlResponse::createLoginRedirectResponse());
        }
    }
}