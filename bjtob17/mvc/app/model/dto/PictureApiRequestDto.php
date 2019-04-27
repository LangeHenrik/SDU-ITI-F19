<?php


namespace app\model\dto;


class PictureApiRequestDto
{
    /**
     * @var int
     */
    public $user_id;

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

    /**
     * PictureApiRequestDto constructor.
     * @param string $image
     * @param string $title
     * @param string $description
     * @param string $username
     * @param string $password
     */
    public function __construct(string $image, string $title, string $description, string $username, string $password)
    {
        $this->image = $image;
        $this->title = $title;
        $this->description = $description;
        $this->username = $username;
        $this->password = $password;
    }

    public static function fromArray(array $arr)
    {
        return new PictureApiRequestDto(
            $arr["image"], $arr["title"], $arr["description"], $arr["username"], $arr["password"]
        );
    }


}