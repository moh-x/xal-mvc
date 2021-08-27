<?php

namespace app\models;

use app\core\Model;

class RegisterModel extends Model
{
    public String $fullname = '';
    public String $email = '';
    public String $password = '';
    public String $confirmPassword = '';

    public function register() {
        echo "Creating new user!";
    }

    public function rules(): array
    {
        // TODO: Implement rules() method.
        return [
            'fullname' => [self::REQUIRED_RULE],
            'email' => [self::REQUIRED_RULE, self::EMAIL_RULE],
            // TODO: Match these folks.
            'password' => [
                self::REQUIRED_RULE,
                [self::MIN_RULE, 'min' => 8],
                [self::MAX_RULE, 'max' => 24]
            ],
            'confirmPassword' => [ self::REQUIRED_RULE,
                [self::MATCH_RULE, 'match' => 'password'] ],
        ];
    }

}