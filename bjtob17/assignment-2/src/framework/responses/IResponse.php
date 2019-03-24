<?php

namespace framework\responses;

interface IResponse
{
    function getContentType(): string;

    function getContent(): string;

    function getResponseCode(): int;
}