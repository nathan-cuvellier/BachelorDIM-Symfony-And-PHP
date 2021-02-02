<?php

namespace App\model;

class TaskRepository
{
    const TABLE = "tasks";

    public function Initialize()
    {
        $pdo = Database::getInstance();

        $exists = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='" . self::TABLE . "'")->fetch();

        if (!$exists) {
            $pdo->exec(
                "create table " . self::TABLE . " (
                    id INTEGER
                        constraint tasks_pk
                            primary key autoincrement,
                    name TEXT,
                    checked INTEGER default 0
                );
                INSERT INTO ". self::TABLE ." (name, checked) VALUES ('Task to be done', 0), ('Task done', 1)");
            
        }
    }

    public function getAll()
    {
        return Database::getInstance()
            ->query("SELECT * FROM " . self::TABLE . ' ORDER BY checked DESC');
    }

    public function update($id, $checked = false)
    {
        return Database::getInstance()
            ->prepare('UPDATE ' . self::TABLE . ' SET checked = :checked WHERE id = :id')
            ->execute([
                'checked' => $checked,
                'id' => $id
            ]);
    }

    public function add($description): bool
    {
        return Database::getInstance()
            ->prepare('INSERT INTO ' . self::TABLE . ' (name) VALUES(:name)')
            ->execute([
                'name' => $description
            ]);
    }

    public function delete($id): bool
    {
        return Database::getInstance()
            ->prepare('DELETE FROM ' . self::TABLE . ' WHERE id = :id')
            ->execute([
                'id' => $id
            ]);
    }
}
