<?php
/**
 * Created by IntelliJ IDEA.
 * User: bt
 * Date: 22/02/19
 * Time: 22:36
 */

namespace Models\Dto;


class PhotoDto
{
    public $title;
    public $caption;
    public $imgName;
    public $authorId;

    /**
     * PhotoDto constructor.
     * @param $title
     * @param $caption
     * @param $imgName
     * @param $authorId
     */
    public function __construct($title, $caption, $imgName, $authorId)
    {
        $this->title = $title;
        $this->caption = $caption;
        $this->imgName = $imgName;
        $this->authorId = $authorId;
    }


}