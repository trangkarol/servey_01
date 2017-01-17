<?php

namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Socialite\SocialAccountRepository;
use Socialite;
use Auth;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(SocialAccountRepository $service, $provider)
    {
        $user = $service->createOrGetUser(Socialite::driver($provider)->user(), $provider);

        if ($user->isActive()) {
            auth()->login($user);

            return redirect()->action('HomeController@index');
        }

        return redirect()->action('Auth\LoginController@getLogin')->with('message', trans('message.block'));
    }
}
