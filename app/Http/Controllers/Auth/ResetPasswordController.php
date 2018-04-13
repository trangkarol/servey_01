<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Exception;
use Session;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showFormReset($token = null)
    {
        return view('clients.user.auth.reset-password')->with([
            'token' => $token,
        ]);
    }

    public function resetPasswordUser(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        try {
            $response = $this->broker()->reset(
                $this->credentials($request), function ($user, $password) {
                    $this->resetPasswordProcess($user, $password);
                }
            );

            return $response == Password::PASSWORD_RESET
                ? $this->sendResetResponse($response)
                : $this->sendResetFailedResponse($request, $response);
        } catch (Exception $e) {
            Session::flash('exception', $e->getMessage());

            return back();
        }
    }

    protected function resetPasswordProcess($user, $password)
    {
        $user->forceFill([
            'password' => $password,
            'remember_token' => Str::random(60),
        ])->save();

        $this->guard()->login($user);
    }
}
