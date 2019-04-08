<?php


namespace app\model\dto;


class PictureDto
{
    /**
     * @var string
     */
    public $image;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $userId;

    /**
     * PictureDto constructor.
     * @param string $image
     * @param string $title
     * @param string $description
     */
    public function __construct(string $image, string $title, string $description, int $userId)
    {
        $this->image = $image;
        $this->title = $title;
        $this->description = $description;
        $this->userId = $userId;
    }


    public static function fromArray(array $arr): PictureDto
    {
        return new PictureDto(
            $arr["image"],
            $arr["title"],
            $arr["description"],
            $arr["userId"]
        );
    }

}