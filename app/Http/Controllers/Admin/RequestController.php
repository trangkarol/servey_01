<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Request\RequestInterface;
use App\Repositories\User\UserInterface;
use DB;
use Exception;
use Auth;

class RequestController extends Controller
{
    protected $requestRepository;
    protected $userRepository;

    public function __construct(
        RequestInterface $requestRepository,
        UserInterface $userRepository
    ) {
        $this->requestRepository = $requestRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $requests = $this->requestRepository->paginate(config('settings.paginate'));

        return view('admin.pages.requests.list', compact('requests'));
    }

    public function store(Request $request)
    {
        $isSuccess = false;

        if ($request->ajax()) {
            $emailUser = $request->get('emailUser');
            $content = $request->get('content');
            $type = $request->get('type');
            $user = $this->userRepository->where('email', $emailUser)->first()->id;

            if (!$user) {
                return respon()->json(['success' => false]);
            }

            $inputs = [
                'content' => $content,
                'admin_id' => auth()->id(),
                'member_id' => $user,
                'action_type' => $type,
                'status' => config('settings.request.watting'),
            ];
            DB::beginTransaction();
            try {
                $this->requestRepository->create($inputs);
                $isSuccess = true;
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
            }
        }

        return ['success' => $isSuccess];
    }

    public function update($id, Request $request)
    {
        $isSuccess = false;

        if ($request->ajax()) {
            DB::beginTransaction();
            try {
                $this->requestRepository->update($id, ['status' => 1]);
                $request = $this->requestRepository->find($id);
                $option = ($request->action_type)
                    ? ['level' => config('users.level.admin')]
                    : ['status' => config('users.status.block')];
                $this->userRepository->changeStatus($request->member_id, $option);
                $isSuccess = true;
                DB::commit();
            } catch(Exception $e) {
                DB::rollback();
            }
        }

        return ['success' => $isSuccess];
    }

    public function destroy(Request $request)
    {
        $isSuccess = false;

        if ($request->ajax()) {
            DB::beginTransaction();
            try {
                $this->requestRepository->delete($request->get('requestId'));
                DB::commit();
                $isSuccess = true;
            } catch (Exception $e) {
                DB::rollback();
            }
        }

        return ['success' => $isSuccess];
    }
}
