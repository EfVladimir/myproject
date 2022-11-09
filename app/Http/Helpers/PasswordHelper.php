<?php

namespace App\Http\Helpers;

use App\Exceptions\IncorrectPassword;
use Illuminate\Support\Facades\Hash;

class PasswordHelper
{

    public static function hashPassword($password){
        $hashed_password = Hash::make($password);
        return $hashed_password;
    }

    public static function checkPassword($password, $hashed_passwrod){
        if (self::hashPassword($password) !== $hashed_passwrod){
            throw new IncorrectPassword();
        }

        return true;
    }

}
