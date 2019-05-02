<?php


namespace models;


class CreateCommentRequest
{
    /**
     * @var string
     */
    public $text;

    /**
     * @var int
     */
    public $feedEntryId;

    /**
     * Validates that the request makes sense
     *
     * @return ValidationError|null
     */
    public function validate()
    {
        if (!$this->text) {
            return new ValidationError("Missing text");
        }
        if (!$this->feedEntryId) {
            return new ValidationError("Missing feedEntryId");
        }

        return null;
    }
}