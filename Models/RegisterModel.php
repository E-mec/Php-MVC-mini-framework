<?php

namespace App\Models;

use App\Core\Model;

class RegisterModel extends Model
{
    public string $fName = '';
    public string $lName = '';
    public string $email = '';
    public string $password = '';
    public string $c_password = '';

    public function register()
    {
        echo "Creating new user";
    }

    public function rules(): array
    {
        return [
            'fName' => [self::RULE_REQUIRED],
            'lName' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8],   [self::RULE_MAX, 'max' => 24]],
            'c_password' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }
}