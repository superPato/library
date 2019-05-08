<?php

namespace Framework;

class DatabaseTable {

    private $pdo;
    private $table;
    private $primaryKey;

    public function __construct(\PDO $pdo, string $table, string $primaryKey = 'id')
    {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    private function query(string $sql, array $parameters = [])
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($parameters);
        return $statement;
    }

    public function total()
    {
        $statement = $this->query("SELECT COUNT(*) FROM `{$this->table}`");
        return $statement->fetch()[0];
    }

    public function findById($valueId)
    {
        $parameters = [':id' => $valueId];
        $statement = $this->query("SELECT * FROM {$this->table} WHERE `{$this->primaryKey}` = :id", $parameters);

        return $statement->fetch();
    }

    public function find($column, $value)
    {
        $statement = $this->query(
            "SELECT * FROM {$this->table} WHERE `{$column}` = :value", 
            [':value' => $value]
        );

        return $statement->fetchAll();
    }

    public function findAll()
    {
        return $this
            ->query("SELECT * FROM `{$this->table}`")
            ->fetchAll();
    }

    private function insert(array $fields)
    {
        $placeholders = $this->getStringPlaceholders($fields);
        $sql = "INSERT INTO `{$this->table}` SET {$placeholders}";

        $this->query($sql, $fields);
    }

    private function edit(array $fields)
    {
        $placeholders = $this->getStringPlaceholders($fields);
        $sql = "UPDATE `{$this->table}` SET {$placeholders} WHERE `{$this->primaryKey}` = :id";

        $this->query($sql, $fields);
    }

    public function save(array $record)
    {
        try {
            if ($record[$this->primaryKey] == '') {
                $record[$this->primaryKey] = null;
            }
            $this->insert($record);
        } catch (\PDOException $e) {
            $this->edit($record);
        }
    }

    public function delete($valueId)
    {
        $parameters = [':id' => $valueId];

        $this->query("DELETE FROM `{$this->table}` WHERE `{$this->primaryKey}` = :id", $parameters);
    }

    private function getStringPlaceholders($fields)
    {
        $placeholders = '';
        foreach (array_keys($fields) as $key) {
            $placeholders .= "`{$key}` = :{$key},";
        }

        return rtrim($placeholders, ',');
    }

}