<?php

class ProductGateway
{
    private PDO $conn;
    
    public function _construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }

    public function getAll(): array
    {
        $sql = "SELECT *
                FROM product";

        $stmt = $this->conn->query($sql);

        $data = [];

        while ($row = $stmt->fetch(PDO::FECTH_ASSOC)) {

            $data[] = $row;
        }

        return $data;
    }
}