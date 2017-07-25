<?php

declare(strict_types=1);

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;
use Todora\Kernel;

require __DIR__ . "/../vendor/autoload.php";

if (!getenv("APP_ENV")) {
    (new Dotenv())->load(__DIR__."/../.env");
}

if (getenv("APP_DEBUG")) {
    Debug::enable();
}

$kernel = new Kernel(getenv("APP_ENV"), getenv("APP_DEBUG"));
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
