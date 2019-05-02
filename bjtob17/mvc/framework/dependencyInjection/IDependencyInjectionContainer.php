<?php


namespace framework\dependencyInjection;


interface IDependencyInjectionContainer
{
    function register($clazz, $implString);

    function get($clazz);

    function has($clazz);
}