<?php

namespace App\Http\Controllers;

use App\Repositories\Feedback\FeedbackInterface;
use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequest;
use DB;
use Exception;

class FeedbackController extends Controller
{
    protected $feedbackRepository;

    public function __construct(FeedbackInterface $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    public function index()
    {
        $feedbacks = $this->feedbackRepository->paginate();

        return view('admin.pages.feedbacks.list', compact('feedbacks'));
    }

    public function create(FeedbackRequest $request)
    {
        $value = $request->only('name','email','content');

        DB::beginTransaction();
        try {
            $this->feedbackRepository->create($value);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->action('SurveyController@index')
                ->with('message', trans('messages.object_created_unsuccessfully', 4));
        }

        return redirect()->action('SurveyController@index')
            ->with('message', trans('messages.object_created_successfully', 4));
    }

    public function update(Request $request)
    {
        $success = false;

        if (!$request->ajax()) {
            return response()->json([
                'success' => $success,
            ]);
        }

        $id = $request->get('id');
        DB::beginTransaction();
        try {
            if (!$request->get('status')) {
                $this->feedbackRepository->update($id, [
                    'status' => true,
                ]);

                DB::commit();
            }

            $success = true;
        } catch (Exception $e) {
            DB::rollback();
        }

        return response()->json([
            'success' => $success,
        ]);
    }

    public function show($id)
    {
        $feedback = $this->feedbackRepository->find($id);

        if (!$feedback) {
            return redirect()->action('ReviewController@index')
                ->with('message', trans('messages.object_not_found', 4));
        }

        return view('admin.pages.feedbacks.detail', compact('feedback'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->feedbackRepository->delete($id);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->action('ReviewController@index')
                ->with('message', trans('messages.object_deleted_unsuccessfully', 4));
        }

        return redirect()->action('ReviewController@index')
            ->with('message', trans('messages.object_deleted_successfully', 4));
    }

    public function getFeedback()
    {
        return view('user.pages.feedback');
    }
}
