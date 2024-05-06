<?php

class ErrorHandle
{
    public static function handleException(Throwable $exception): void
    {
        http_response_code(500);
        
        echo json_encode([
            "code" => $exception->getCode(),
            "message" => $exception->getMessage(),
            "file" => $exception->getLine()
        ]);
    }
}