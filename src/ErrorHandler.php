<?php

class ErrorHandle
{
    public static function handleException(Throwable $exception): void
    {
        echo json_encode([
            "code" => $exception->getCode(),
            "message" => $exception->getMessage(),
            "file" => $exception->getLine()
        ]);
    }
}