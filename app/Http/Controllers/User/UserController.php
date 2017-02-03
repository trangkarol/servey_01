<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\Hash;
use Auth;

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

        return view('user.edit', compact('user'));
    }

    public function update(EditUserRequest $request)
    {
        $isSuccess = false;
            $updateData = $request->only([
                'email',
                'password',
                'name',
                'image',
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

                if (isset($updateData['image'])) {
                    $updateData['image'] = $this->userRepository->uploadAvatar($input['image']);
                } else {
                    $updateData = $request->except(['image']);
                }

                if ($this->userRepository->update(auth()->id(), $updateData)) {
                    $isSuccess = true;
                }
            }

        return redirect()->action('User\UserController@show')
            ->with('message', ($isSuccess)
                ? trans('messages.object_updated_successfully', ['object' => class_basename(User::class)])
                : trans('messages.object_updated_unsuccessfully', ['object' => class_basename(User::class)]));
    }
}
