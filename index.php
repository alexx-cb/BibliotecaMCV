<?php
session_start();
require 'vendor/autoload.php';
require "Config/Config.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

use Controllers\FrontController;
FrontController::main();