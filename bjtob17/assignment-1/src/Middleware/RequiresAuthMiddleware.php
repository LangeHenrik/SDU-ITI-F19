<?php

namespace Middleware;

use Routing\IRequest;
use Services\Auth;

class RequiresAuthMiddleware extends AbstractMiddleware
{

    public function apply(IRequest $request): array
    {
        if (Auth::isLoggedIn()) {
            return $this->next($request, "Logged in");
        } else {
            return $this->stop($request, "Not logged in");
        }
    }
}