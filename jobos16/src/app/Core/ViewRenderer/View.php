<?php

namespace App\Core\ViewRenderer;


class View
{

    private $content = "";
    private $data = [];
    private $renderer;

    public function __construct($content, array $data)
    {
        $this->content = $content;
        $this->data = $data;
        $this->renderer = new Renderer();
    }

    public static function create(string $path, array $data = []) {
        $path = str_replace(".", DIRECTORY_SEPARATOR, $path);
        return new View(file_get_contents(__DIR__ . "/../../../views/{$path}.view.php"), $data);
    }

    public function render() {
        return $this->renderer->render($this->content, $this->data);
    }
}