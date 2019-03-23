<?php

namespace framework\database;

interface IDatabaseConnection
{
    public function getPDO(): PDO;
}