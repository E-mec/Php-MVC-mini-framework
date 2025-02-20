<?php 

namespace App\Core\DB;

use App\Core\Model;
use App\Core\Application;

abstract class DbModel extends Model
{
    abstract public static function tableName(): string;

    abstract public function attributes(): array;
    abstract public static function primaryKey(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($m) => ":$m", $attributes);

        $sql = "INSERT INTO $tableName (".implode(',', $attributes).") VALUES(".implode(',', $params).")";
        $statement = self::prepare($sql);

        foreach ($attributes as $attribute)
        {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();

        return true;

    }

    public static function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

        foreach ($where as $key => $value)
        {
            $statement->bindValue(":$key", $value);
        }

        $statement->execute();

        return $statement->fetchObject(static::class);
    }

    public static function prepare( $sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
    
}