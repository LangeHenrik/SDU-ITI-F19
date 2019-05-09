<?php
declare(strict_types=1);

namespace models\horribleApi;


class HorribleUploadPictureRequest
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
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;
}