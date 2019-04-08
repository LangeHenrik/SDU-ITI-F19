<?php


namespace app\middleware;


use app\service\IAuthService;
use framework\middleware\AbstractMiddleware;
use framework\response\JsonResponse;
use framework\routing\IRequest;

class ApiAuthMiddleware extends AbstractMiddleware
{

    /**
     * @var IAuthService
     */
    private $authService;

    /**
     * ApiAuthMiddleware constructor.
     * @param IAuthService $authService
     */
    public function __construct(IAuthService $authService)
    {
        $this->authService = $authService;
    }


    public function handle(IRequest $request): array
    {
        $username = $request->getBodyAsJson("json")->username;
        $password = $request->getBodyAsJson("json")->password;
        if ($this->authService->isLoggedInApi($username, $password)) {
            return $this->next($request);
        } else {
            return $this->fail($request, JsonResponse::create401Response());
        }
    }
}