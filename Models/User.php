<?php

namespace App\Models;

use App\Core\DbModel;
use App\Core\Model;
use App\Core\UserModel;

class User extends UserModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public int $id ;
    public string $fName = '';
    public string $lName = '';
    public string $email = '';
    public int $status = self::STATUS_INACTIVE;
    public string $password = '';
    public string $c_password = '';
    public string $created_at = '';

    public static function tableName(): string
    {
        return 'users';
    }

    public function save()
    {
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
        
    }

    public function rules(): array
    {
        return [
            'fName' => [self::RULE_REQUIRED],
            'lName' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8],   [self::RULE_MAX, 'max' => 24]],
            'c_password' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function attributes(): array
    {
        return [
            'fName',
            'lName',
            'email',
            'password',
            'status',
        ];
    }

    public static function primaryKey():string
    {
        return 'id';
    }

    public function labels(): array
    {
        return [
            'fName' => 'First Name',
            'lName' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'c_password' => 'Confirm Password',
            
        ];
    }

    public function getDisplayName(): string
    {
        return $this->fName.' '.$this->lName;
    }
}
