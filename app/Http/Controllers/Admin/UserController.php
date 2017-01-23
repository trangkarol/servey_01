<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->paginate(config('settings.paginate'));
        $userActives = $users->where('status', config('users.status.active'));
        $userBlocks = $users->where('status', config('users.status.block'));

        return view('admin.pages.users.list', compact('userActives', 'userBlocks', 'users'));
    }

    public function changeStatus($status, Request $request)
    {
        $userIds = $request->get('checkbox-user-active') ?: $request->get('checkbox-user-block');

        if ($this->userRepository->multiUpdate('id', $userIds, ['status' => $status])) {
            return redirect()->action('Admin\UserController@index')->with('message-success', 'admin.update.success');
        }

        return redirect()->action('Admin\UserContorller@index')->with('message-fail', 'admin.update.fail');
    }

    public function show($id)
    {
        if ($user = $this->userRepository->find($id)) {
            return view('admin.pages.users.edit', compact('user'));
        }

        return view('admin.pages.users.list')->with('message-fail', trans('user.not_fount'));
    }

    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if ($user) {
            $input = $request->only([
                'name',
                'birthday',
                'phone',
                'address',
                'gender',
                'image',
            ]);

            if (isset($input['image'])) {
                $input['image'] = $this->userRepository->uploadAvatar($input['image']);
            } else {
                $input = $request->except(['image']);
            }

            if ($this->userRepository->update($user->id, $input)) {
                return redirect()->action('Admin\UserController@show', $user->id)
                    ->with('message-success', trans('admin.update.success'));
            }

            return redirect()->action('Admin\UserController@show', $user->id)->with('message-fail', trans('admin.update.fail'));
        }

        return redirect()->action('Admin\UserController@show', $user->id)->with('message-fail', trans('admin.error'));
    }

    public function search(Request $request)
    {
        $input = $request->get('search');
        $users = $this->userRepository->where(
            function($query) use ($input) {
                $query->where('email', 'LIKE', '%' . $input . '%')
                    ->orWhere('name', 'LIKE', '%' . $input . '%');
            })
            ->where('id', '<>', auth()->id())
            ->paginate(config('settings.paginate'));

        $userActives = $users->where('status', config('users.status.active'));
        $userBlocks = $users->where('status', config('users.status.block'));

        if (($users && $userActives) || ($users && $userBlocks)) {
            return view('admin.pages.users.list', compact('userActives', 'userBlocks', 'users'));
        }

        return redirect()->action('Admin\UserController@index')
            ->with('message-fail', trans('admin.not_fount'));
    }
}
