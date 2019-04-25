<?php
declare(strict_types=1);

namespace models\horribleApi;


class HorriblePicturesForUserResponse
{
    /**
     * @var int
     */
    public $image_id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $image;

    /**
     * HorriblePicturesForUserResponse constructor.
     * @param int $image_id
     * @param string $title
     * @param string $description
     * @param string $image
     */
    public function __construct(int $image_id, string $title, string $description, string $image)
    {
        $this->image_id = $image_id;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
    }


}