<?php

require_once __DIR__.'/vendor/autoload.php';

use App\Comunication\Call;
use App\Comunication\Otaku;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
    

Call::getLastMessage();
