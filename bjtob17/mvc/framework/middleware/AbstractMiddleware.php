<?php

namespace framework\middleware;

use framework\response\IResponse;
use framework\routing\IRequest;

abstract class AbstractMiddleware
{
    public abstract function handle(IRequest $request): array;

    public function next(IRequest $request): array
    {
        return [true, $request, null];
    }

    public function fail(IRequest $request, IResponse $response): array
    {
        return [false, $request, $response];
    }
}