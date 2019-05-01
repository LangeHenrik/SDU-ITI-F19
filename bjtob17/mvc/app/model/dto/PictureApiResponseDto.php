<?php


namespace app\model\dto;


use app\model\Picture;

class PictureApiResponseDto
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
     * PictureApiDto constructor.
     * @param string $image
     * @param string $title
     * @param string $description
     */
    public function __construct(string $image, string $title, string $description)
    {
        $this->image = $image;
        $this->title = $title;
        $this->description = $description;
    }

    public static function fromPicture(Picture $picture): PictureApiResponseDto
    {
        return new PictureApiResponseDto(
            $picture->imageData, $picture->title, $picture->description
        );
    }


}