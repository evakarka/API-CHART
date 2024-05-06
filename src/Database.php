<?php

class Database
{
    public function _construct(private string $host,
                               private string $name,
                               private string $user,
                               private string $password)
    {}

    public function getConnection(): PDO
    {
        $dns = "mysql:host={$this->host};dbname={$this->name};charset=utf8";

        return new PDO($dsn, $this->user, $this->password);
    }
}