<?php
namespace Models;

use DateTime;

class Photo extends Entity
{
    public $caption;
    public $imgName;
    public $uploadDate;
    public $author;

    /**
     * Photo constructor.
     * @param $id
     * @param $caption
     * @param $imgName
     * @param $uploadDate
     * @param User $author
     */
    public function __construct(int $id, string $caption, string $imgName, int $uploadDate, User $author)
    {
        $this->id = $id;
        $this->caption = $caption;
        $this->imgName = $imgName;
        $this->uploadDate = $uploadDate;
        $this->author = $author;
    }

    public function formatDate($format = "M d Y, H:i", $timeZone = "Europe/Copenhagen")
    {
        $uploadDate = DateTime::createFromFormat( 'U', $this->uploadDate);
        $uploadDate->setTimezone(new \DateTimeZone($timeZone));
        return $uploadDate->format($format);
    }

}