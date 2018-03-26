<?php

namespace App\Repositories\User;

interface UserInterface
{
    public function changeStatus($input, $status);

    public function uploadAvatar($request, $name, $oldImageName);

    public function findEmail($keyword);
}
