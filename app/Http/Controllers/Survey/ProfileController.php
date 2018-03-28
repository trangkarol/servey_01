<?php

namespace App\Http\Controllers\Survey;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use Auth;
use Carbon\Carbon;
use Session;
use Hash;
use Exception;
use App\Http\Requests\Survey\ChangePassWordRequest;
use App\Http\Requests\Survey\ProfileRequest;

class ProfileController extends Controller
{
    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $user = Auth::user();

            return view('survey.profile.index', compact('user'));
        } catch (Exception $e) {
            return view('404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = $this->userRepository->find($id);

            return view('survey.profile.index', compact('user'));
        } catch (Exception $e) {
            return view('404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        try {
            $updateData = $request->only([
                'name',
                'phone',
                'gender',
                'address',
            ]);
            $birthday = $request->birthday;

            if (Session::get('locale') != 'vn') {
                $birthday = str_replace('-', '/', $birthday);
            }

            $updateData['birthday'] = Carbon::parse($birthday)->toDateString();

            if ($request->image != '') {
                $image = $this->userRepository->find($id)->image;
                $updateData['image'] = $this->userRepository->
                    uploadAvatar($request, 'image', $image);
            }

            $user = $this->userRepository->update($id, $updateData);

            return redirect()->back()->with('success', trans('lang.edit_success'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', trans('lang.edit_error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showChangePassword()
    {
        return view('survey.profile.changepassword');
    }

    public function changePassword(ChangePassWordRequest $request)
    {
        try {
            $user = Auth::user();

            if (!Hash::check($request->oldpassword, $user->password)) {
                $error = trans('lang.password_wrong');
                throw new Exception();
            }

            if ($request->newpassword != $request->retypepassword) {
                $error = trans('lang.password_confirm_wrong');
                throw new Exception();
            }

            $data['password'] = $request->newpassword;
            $user->update($data);
            Session::flash('success', trans('lang.edit_success'));
        } catch (Exception $e) {
            Session::flash('error', $error);
        }

        return redirect()->back();
    }
}
