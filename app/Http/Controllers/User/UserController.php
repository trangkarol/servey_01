<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\Hash;
use Auth;
use Carbon\Carbon;
use Session;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show()
    {
        $user = $this->userRepository->find(auth()->id());
        $hasFramgiaAccount = $user->socialAccounts()->where('provider', config('settings.framgia'))->exists() ?: null;

        return view('user.pages.update-info', compact('user', 'hasFramgiaAccount'));
    }

    public function update(EditUserRequest $request)
    {
        $isSuccess = false;
        $updateData = $request->only([
            'email',
            'password',
            'name',
            'imageUser',
            'phone',
            'gender',
            'birthday',
            'address',
            'old-password',
        ]);

        if ($updateData['password'] && Hash::check($updateData['old-password'], Auth::user()->password)
            || !$updateData['password']
        ) {
            $updateData = $request->except(['old-password']);

            if (empty($updateData['birthday'])) {
                $updateData = array_except($updateData, ['birthday']);
            } else {
                $updateData['birthday'] = Carbon::parse(in_array(Session::get('locale'), config('settings.sameFormatDateTime'))
                    ? str_replace('-', '/', $updateData['birthday'])
                    : $updateData['birthday'])
                    ->toDateTimeString();
            }

            if (!empty($updateData['imageUser'])) {

                $updateData['image'] = $this->userRepository->uploadAvatar($updateData['imageUser']);
                $updateData = array_except($updateData , ['imageUser']);
            } else {
                $updateData = array_except($updateData , ['imageUser']);
            }

            if ($this->userRepository->update(auth()->id(), $updateData)) {
                $isSuccess = true;
            }
        }

    return redirect()->action('User\UserController@show')
        ->with('message', ($isSuccess)
            ? trans_choice('messages.object_updated_successfully', 0)
            : trans_choice('messages.object_updated_unsuccessfully', 0));
    }
}
