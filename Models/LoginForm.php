<?php

namespace App\Models;

use App\Core\Model;
use App\Models\User;
use App\Core\Application;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'email' => 'Your Email',
            'password' => 'Password',
        ];
    }
    public function login()
    {
        $userModel = new User();
        $user = $userModel->findOne(['email' => $this->email]);

        if(!$user)
        {
            $this->addError('email', 'Email not found');

            return false;
        }

        if(!password_verify($this->password, $user->password))
        {
            $this->addError('password', 'Password incorrect');

            return false;
        }

        return Application::$app->login($user);
    }
}