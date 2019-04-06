<?php

namespace framework\response;

interface IResponse
{
    function getContentType(): string;

    function getContent(): string;

    function getResponseCode(): int;
}