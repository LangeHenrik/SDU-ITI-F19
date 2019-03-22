<?php


namespace models;


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
}