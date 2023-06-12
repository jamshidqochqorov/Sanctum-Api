<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponse;

    public function login(LoginUserRequest $request){
       if(!Auth::attempt($request->only(['email','password']))){
           return $this->error('','Credentials do not mach',401);
       }
       $user = User::where('email',$request->email)->first();
       return $this->success([
           'user'=>$user,
           'token'=>$user->createToken('api tokon of ' .$user->name)->plainTextToken
       ]);

    }
    public function register(StoreUserRequest $request){

        $user = User::create([
           'name'=>$request->name,
           'email'=>$request->email,
           'password'=>Hash::make($request->password)
        ]);

        return $this->success([
            'user'=>$user,
            'token'=>$user->createToken('API TOKEN OF '. $user->name)->plainTextToken
        ]);
    }
}
