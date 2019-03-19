<?php


namespace models;


class CreateFeedEntryRequest
{
    /**
     * @var string
     */
    public $title = null;

    /**
     * @var string
     */
    public $description = null;

    /**
     * @var array
     */
    public $image = null;

    public function __toString()
    {
        return "CreateFeedEntryRequest($this->title, $this->description)";
    }


    /**
     * @return string|null
     */
    public function validate()
    {
        if (!$this->title || !strlen(trim($this->title))) {
            return "Missing title";
        }
        if (!$this->description || !strlen(trim($this->description))) {
            return "Missing description";
        }

        if (!$this->image) {
            return "Missing image file";
        }

        if ($error = $this->image['error']) {
            switch ($error) {
                case '1':
                    return "Image is too large";
                default:
                    return "Unknown upload error: " . $error;
            }
        }

        if (!@getimagesize($this->image['tmp_name'])) {
            return "Image was not an image";
        }

        return null;
    }
}