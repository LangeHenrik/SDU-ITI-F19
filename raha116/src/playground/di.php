<?php

namespace playground;


use framework\DependencyContainer;

$container = new DependencyContainer();

class Foo
{

}

$container->get_service(Foo::class);
