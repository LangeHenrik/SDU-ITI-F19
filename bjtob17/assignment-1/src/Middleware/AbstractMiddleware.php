<?php


namespace Middleware;


use Routing\IRequest;

abstract class AbstractMiddleware
{
    public abstract function apply(IRequest $request);

    public function next(IRequest $request, string $msg): array
    {
        return [true, $msg];
    }

    public function stop(IRequest $request, string $msg): array
    {
        return [false, $msg];
    }
}