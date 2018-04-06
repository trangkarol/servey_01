<?php

namespace App\Repositories\User;

interface UserInterface
{
    public function changeStatus($input, $status);

    public function uploadAvatar($request, $name, $oldImageName, $pathUpload);

    public function findEmail($keyword);

    public function updateUser($request, $user);

    public function checkEmailExist($email);
}
