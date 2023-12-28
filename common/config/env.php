<?php
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../");
$dotenv->load();

defined('YII_DEBUG') or define('YII_DEBUG', getenv('YII_DEBUG') != null);
defined('YII_ENV') or define('YII_ENV', getenv('YII_ENV') ?: 'prod');