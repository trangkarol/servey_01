<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getLogin()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $data = $request->only([
            'email',
            'password',
        ]);

        if (Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
            'status' => config('users.status.active')
        ])) {
            return redirect()->action('HomeController@index');
        }

        return redirect()->action('Auth\LoginController@getLogin')->with('message', trans('auth.failed'));
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->action('Auth\LoginController@getLogin');
    }
}
