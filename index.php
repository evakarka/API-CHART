<?php

declare(string_types=1);

spl_autoload_register(function ($class) {
    require _DIR_ . "/src/$class.php";
});

set_exception_handler("ErrorHandle::handleException");

header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URL"]);

if ($parts[1] != "products"){
    http_response_code(404);
    exit;
}

$id = $parts[2] ?? null;

$database = new Database("localhost", "product_db", "root", "");

$gateway = new ProductGateway($database);

$controller = new ProductController($gateway);

$constroller->processRequest($_SERVER["REQUEST_METHOD"], $id);