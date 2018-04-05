<?php

namespace App\Http\Controllers\Api1\Auth;

use App\Http\Controllers\Api1\ApiController;
use Illuminate\Http\Request;
use App\Services\PassportService;
use FAuth;
use Session;
class AuthenticationController extends ApiController
{
    public function requestAccessToken(
        Request $request, 
        PassportService $passport
    ) {
        $data = [
            'email' => $request->email,
            'password' => '',
        ];

        return $this->getData(function () use ($passport, $data) {
            $this->compacts['auth'] = $passport->requestGrantToken($data);
        });
    }

    public function authentication()
    {
        Session::put('request-access-token', true);

        return FAuth::redirect();
    }
}
