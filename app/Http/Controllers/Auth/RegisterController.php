<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\RegisterRequest;
use App\Repositories\User\UserRepository;
use Carbon\Carbon;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getRegister()
    {
        if (Auth::guard()->check()) {
            return view('user.pages.home');
        }

        return view('user.pages.register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->only([
            'name',
            'email',
            'password',
            'gender',
            'image',
        ]);

        $input = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'level' => config('users.level.user'),
            'status' => config('users.status.active'),
            'image' => $this->userRepository->uploadAvatar($data['image']),
            'gender' => $data['gender'],
        ];
        $user = $this->userRepository->firstOrCreate($input);

        if ($user) {
            Auth::login($user);

            return redirect()->action('SurveyController@index');
        }

        return redirect()
            ->action('Auth\LoginController@getRegister')
            ->with('message', trans('message.register_fail'));
    }
}
