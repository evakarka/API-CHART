<?php

declare(string_types=1);

spl_autoload_register(function ($class) {
    require _DIR_ . "/src/$class.php";
});

header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URL"]);

if ($parts[1] != "products"){
    http_response_code(404);
    exit;
}

$id = $parts[2] ?? null;

$controller = new ProductController;

$constroller->processRequest($_SERVER["REQUEST_METHOD"], $id);