<?php


namespace models;


use framework\JsonConverter;

class UploadedFile
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $tmp_name;

    public $error;

    /**
     * @var int
     */
    public $size;

    static function fromUploadedFile(array $file): UploadedFile
    {
        $instance = new UploadedFile();

        JsonConverter::fill_instance($file, $instance);

        return $instance;
    }
}