<?php

namespace App\Migrations;

use App\Core\Application;

class m001_initial
{
    public function up(): void
    {
        $db = Application::$app->db;

        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            fName VARCHAR(255) NOT NULL,
            lName VARCHAR(255) NOT NULL,
            status TINYINT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )ENGINE=INNODB;";

        $db->pdo->exec($sql);
    }

    public function down(): void
    {
        $db = Application::$app->db;

        $sql = "DROP TABLE users;";

        $db->pdo->exec($sql);
    }
}