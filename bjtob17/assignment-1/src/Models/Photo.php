<?php
namespace Models;

use DateTime;

class Photo extends Entity
{
    public $title;
    public $caption;
    public $imgName;
    public $uploadDate;
    public $author;

    /**
     * Photo constructor.
     * @param int $id
     * @param string $title
     * @param string $caption
     * @param string $imgName
     * @param int $uploadDate
     * @param User $author
     */
    public function __construct(int $id, string $title, string $caption, string $imgName, int $uploadDate, User $author)
    {
        $this->id = $id;
        $this->title = $title;
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