<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SendEmailResetPassword;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Repositories\User\UserInterface;

class ForgotPasswordController extends Controller
{
    protected $userRepository;
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserInterface $userRepository)
    {
        $this->middleware('guest');
        $this->userRepository = $userRepository;
    }

    public function sendMailResetPassword(SendEmailResetPassword $request)
    {
        $email = $request->input('email');
        $isExisted = $this->userRepository->checkEmailExist($email);

        if ($isExisted) {
            $this->sendResetLinkEmail($request);

            return response()->json(true);
        }

        return response()->json(false);
    }
}
