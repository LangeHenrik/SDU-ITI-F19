<?php
namespace Database\Interfaces;

use PDO;

interface IDatabaseConnection
{
    public function getPDO(): PDO;
}