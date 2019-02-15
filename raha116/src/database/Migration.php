<?php
declare(strict_types=1);

namespace database;


use DateTime;

class Migration
{
    public $name = "";

    public $date;

    /**
     * Migration constructor.
     */
    public function __construct()
    {
        $this->date = new DateTime();
    }

    public function __toString()
    {
        return "Migration(" . $this->name . ", " . $this->date->getTimestamp() . ")";
    }

}