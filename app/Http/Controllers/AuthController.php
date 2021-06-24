<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Logs in a user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function login(Request $request)
    {
        $credentials['email'] = $request->input('email');
        $credentials['password'] = $request->input('password');

        if (!Auth::attempt($credentials)) {
            return response(['status' => 401, 'message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $credentials['email'])->first();



        $tokenResult = $user->createToken('authToken')->plainTextToken;

        return response(['status' => 200, 'access_token' => $tokenResult, 'token_type' => 'Bearer'], 200);
    }

    /**
     * Logs out a user
     * @param Request $request
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['status' => 200,]);
    }

    /**
     * This function can be called if the user forgets his password.
     * An email will be sent with a link with a special token to reset the password.
     */
    public function request_email_recover(Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return [];

    }


    /**
     * When a user forghet his password a link is sent to his email. The link conteins a token that is
     * used by the frontend to call this function to reset the password.
     */
    public function reset_password(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return [];
    }
}
