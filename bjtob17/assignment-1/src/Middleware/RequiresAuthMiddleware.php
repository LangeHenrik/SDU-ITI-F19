<?php

namespace Middleware;

use Routing\IRequest;
use Helpers\AuthHelper;

class RequiresAuthMiddleware extends AbstractMiddleware
{

    public function apply(IRequest $request): array
    {
        if (AuthHelper::isLoggedIn()) {
            return $this->next($request, "Logged in");
        } else {
            return $this->stop($request, "Not logged in");
        }
    }
}