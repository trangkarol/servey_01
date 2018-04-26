<?php

namespace  App\Repositories\User;

use DB;
use Storage;
use Exception;
use App\Repositories\BaseRepository;
use App\Models\User;
use File;
use Session;
use Carbon\Carbon;
use App\Traits\FileProcesser;

class UserRepository extends BaseRepository implements UserInterface
{
    use FileProcesser;

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function changeStatus($ids, $status)
    {
        DB::beginTransaction();
        try {
            $ids = (is_array($ids) ? $ids : [$ids]);
            $this->multiUpdate('id', $ids, ['status' => $status]);
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollback();

            return false;
        }
    }

    public function uploadAvatar($request, $name, $oldImageName, $pathUpload)
    {
        if ($request->hasFile($name)) {
            $pathFile = $oldImageName;

            if (Storage::disk('local')->exists($oldImageName) && $oldImageName != config('settings.image_user_default')) {
                Storage::disk('local')->delete($oldImageName);
            }

            return $this->uploadImage($request, $name, $pathUpload);
        }
    }

    public function updateUser($user, $updateData)
    {
        return $user->update($updateData);
    }

    public function checkEmailExist($email)
    {
        return $this->model->where('email', $email)->exists();
    }

    public function findEmail($data, $userId)
    {
        $users = $this->model
            ->where('email', 'like', '%' . $data['keyword'] . '%')
            ->where('id', '!=', $userId);

        if (!empty($data['emails']) && count($data['emails'])) {
            $users = $users->whereNotIn('email', $data['emails']);
        }

        return $users->take(config('survey.get_top_mail_suggestion'))->pluck('email');
    }
}
