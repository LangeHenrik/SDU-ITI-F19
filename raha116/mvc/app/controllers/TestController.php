<?php
declare(strict_types=1);

namespace controllers;


use framework\ControllerBase;

class TestController extends ControllerBase
{
    public function test(string $path_foo, int $path_bar)
    {
        return $this->Ok(array("foo" => $path_foo, "bar" => $path_bar));
    }
}