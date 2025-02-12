<?php 

namespace App\Migrations;

use App\Core\Application;

class m002_add_password_column
{
    public function up()
    {
        $db = Application::$app->db;

        $sql = "ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL;";

        $db->pdo->exec($sql);
    }

    public function down(): void
    {
        $db = Application::$app->db;

        $sql = "ALTER TABLE users DROP COLUMN password;";

        $db->pdo->exec($sql);
    }
}