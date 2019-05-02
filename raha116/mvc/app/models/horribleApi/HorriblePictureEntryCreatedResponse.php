<?php
declare(strict_types=1);

namespace models\horribleApi;


class HorriblePictureEntryCreatedResponse
{
    /**
     * @var int
     */
    public $image_id;

    /**
     * HorriblePictureEntryCreatedResponse constructor.
     * @param int $image_id
     */
    public function __construct(int $image_id)
    {
        $this->image_id = $image_id;
    }


}