<?php

class TestClass
{

    function __construct(string $a1)
    {
    }
}

$reflector = new ReflectionClass(TestClass::class);

foreach ($reflector->getConstructor()->getParameters() as $p) {

    echo $p;
    echo "\n";
}
echo "hello from ctor_reflection";


