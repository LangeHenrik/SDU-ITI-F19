<?php


namespace models;


class ImageDatabaseEntry
{
    /**
     * @var string
     */
    public $filehash;

    /**
     * @var string
     */
    public $extension;

    /**
     * @var int
     */
    public $image_id;

    public function getFilename(): string
    {
        return "$this->filehash.$this->extension";
    }
}