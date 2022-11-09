<?php

namespace App\Http\Controllers;

use App\Http\Helpers\PasswordHelper;
use App\Models\User;
use App\Services\TokenService;
use Illuminate\Http\Request;
use Spatie\FlareClient\Http\Exceptions\NotFound;

class AuthController extends Controller
{

    public function register(Request $request){
        //todo make validator
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $hash_password = PasswordHelper::hashPassword($request->password);
        $user->name = $request->name;
        $user->save();

        //todo generate accerss or call login
        return $user;
    }

    public function login(Request $request){
        //todo make validator
        $user = User::where('email', 'like', $request->email)->first();

        if (empty($user)){
            throw new NotFound();
        }

        PasswordHelper::checkPassword($request->password, $user->password);
        $token = TokenService::CreateAccessToken($user->id);
        $result = array($user, $token);
        return $result;
    }
}
