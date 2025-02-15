<?php 

namespace App\Core;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;

    abstract public function attributes(): array;

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

    public static function prepare( $sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
    
}