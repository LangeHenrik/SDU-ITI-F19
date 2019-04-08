<?php

namespace framework\routing;

interface IRequest
{
    public function getBody(): array;

    public function getBodyAsJson(string $formDataKey);
}