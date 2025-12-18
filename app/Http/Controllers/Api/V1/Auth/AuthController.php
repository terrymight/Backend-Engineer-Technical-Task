<?php
namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\auth\Login;
use App\Http\Requests\UserRegistration;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    /**
     * Handle user registration.
     */
    public function register(UserRegistration $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Assign default role
        $user->assignDefaultRole();

        return $this->success(
            $user,
            'User Registration successful',
            201  
        );
    }

    /**
     * Handle user login.
     */
    public function login(Login $request)
    {
        $request->authenticate();
        $user = Auth::user(); 

        // 3. Issue the token on the User model (which has HasApiTokens trait)
        $token = $user->createToken('AuthToken')->accessToken;

        return $this->success(
            ['access_token' => $token],
            'Authentication successful. Access token issued.'
        );
    }

    /**
     * Handle user logout (Revoke the current token).
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function users()
    {
        $users = User::all();
        
        return $this->success(
            $users,
            'Users list returned success',
            200
        );
    }
}