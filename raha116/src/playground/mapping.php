<?php

class Foo
{
    public function __toString()
    {
        return "Foo";
    }

}

class Bar
{
    public function __toString()
    {
        return "Bar";
    }

}

$cache = array();

$cache[Foo::class] = new Foo();
$cache[Bar::class] = new Bar();

echo $cache[Foo::class] . "\n";

$exists = $cache[Bar::class] != null;

if ($exists) {
    echo "It's there!";
} else {
    echo "It's not there!";
}

