<?php


namespace framework\util;


interface IConfig
{
    function getConfig(): array;

    function get(string $key);
}