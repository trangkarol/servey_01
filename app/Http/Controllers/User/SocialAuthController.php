<?php

namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Socialite\SocialAccountRepository;
use App\Services\PassportService;
use App\Http\Controllers\Api1\ApiController;
use Socialite;
use Auth;
use FAuth;
use Exception;
use Session;

class SocialAuthController extends ApiController
{
    public function redirect($provider)
    {        
        return $provider == config('settings.framgia') ? FAuth::redirect() : Socialite::driver($provider)->redirect();
    }

    public function callback(SocialAccountRepository $service, $provider, PassportService $passport)
    {
        $driver = $provider == config('settings.framgia') ? FAuth::driver($provider) : Socialite::driver($provider);

        try {
            $user = $service->createOrGetUser($driver->user(), $provider);
            auth()->login($user);

            if (Session::has('request-access-token')) {
                Session::forget('request-access-token');

                return redirect('http://poll.local/');
            }

            if (Session::has('nextUrl')) {
                $url = Session::get('nextUrl');
                Session::forget('nextUrl');

                return redirect()->intended($url);
            }

            return redirect()->intended(action('SurveyController@index'));

        } catch (Exception $e) {
            return redirect()->action('SurveyController@index')
                ->with('message-fail', trans('messages.login_social_error', ['object' => $provider]));
        }
            return redirect()->action('Auth\LoginController@getLogin')
            ->with('message', trans('messages.block'));
    }
}
