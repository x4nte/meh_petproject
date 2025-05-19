<?php

namespace App\Core\Database;

use App\Core\Config\Config;
use App\Core\Config\DatabaseConfig;
use PDO;

class Database
{
    private PDO $pdo;

    public function __construct(private DatabaseConfig $config)
    {
    }

    public function connect(): self
    {
        $driver = $this->config->get('driver');
        $file = $this->config->get('file');
        $file = APP_PATH . $file;

        $this->pdo = new PDO("$driver:$file");
        return $this;
    }

    public function insert($table, array $data)
    {
        $keys = implode(', ', array_keys($data));
        $binds = implode(', ', array_map(fn($key) => ":$key", array_keys($data)));

        $query = "INSERT INTO $table ($keys) VALUES ($binds)";
        $this->query($query, $data);
    }

    private function buildWhere($sql, $where) : string
    {
        $keys = array_keys($where);

        foreach ($keys as $i => $key) {
            if ($i == 0) {
                $sql .= " WHERE ";
            } else {
                $sql .= " AND ";
            }
            $sql .= "$key = :$key";
        }
        return $sql;
    }

    public function delete($table, $where)
    {
        $sql = "DELETE FROM $table";

        $sql = $this->buildWhere($sql, $where);

        return $this->query($sql, $where);
    }

    public function update($table,array $data, array $where)
    {
        $sql = "UPDATE $table SET ";
        $binds = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
        $sql .= $binds;
        $sql = $this->buildWhere($sql, $where);
        return $this->query($sql, array_merge($where, $data));
    }

    public function findAll(string $table, array $where)
    {
        $sql = "SELECT * FROM $table";
        $sql = $this->buildWhere($sql, $where);

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($where);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function find(string $table, array $where)
    {
        $sql = "SELECT * FROM $table";
        $sql = $this->buildWhere($sql, $where);

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($where);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function query($query, array $params = []): bool
    {
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($params);
    }


}