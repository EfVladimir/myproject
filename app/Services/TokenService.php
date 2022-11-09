<?php

namespace App\Services;

use App\Http\Helpers\JWT;
use App\Models\Token;
use http\Env\Request;

class TokenService
{
    public static function CreateAccessToken($user_id){
        $a = new JWT($user_id);
        $token = $a::Generate();
        return $token;
    }
}
