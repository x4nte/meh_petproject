<?php

namespace App\Core\Database;

use App\App;

class Migrator
{
    public function __construct(private Database $database)
    {
    }

    public function migrate()
    {
        $this->database->query("
            CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            email TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL
        )");
        $this->database->query("
    CREATE TABLE IF NOT EXISTS posts (
      id        INTEGER PRIMARY KEY AUTOINCREMENT,
      title     TEXT    NOT NULL,
      body      TEXT    NOT NULL,
      user_id   INTEGER NOT NULL,
      FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
    );
");

    }
}