<?php

namespace  App\Repositories\User;

use DB;
use Storage;
use Exception;
use App\Repositories\BaseRepository;
use App\Models\User;
use File;

class UserRepository extends BaseRepository implements UserInterface
{
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

    public function uploadAvatar($request, $name, $oldImageName)
    {
        if ($request->hasFile($name)) {
            $pathFile = $oldImageName;

            if (File::exists(public_path($pathFile)) && $pathFile != config('settings.image_user_default')) {
                File::delete(public_path($pathFile));
            }

            $file = $request->file($name);
            $newFileName = time() . '.'. $file->getClientOriginalExtension();
            $file->move(config('settings.path_upload'), $newFileName);
            
            return $newFileName;
        }
    }

    public function findEmail($keyword)
    {
        return $this->model
            ->where('email', 'like', "%$keyword%")
            ->take(config('survey.get_top_mail_suggestion'))
            ->get()
            ->pluck('email');
    }
}
