<?php

namespace framework\database;

use PDO;

interface IDatabaseConnection
{
    public function getPDO(): PDO;
}