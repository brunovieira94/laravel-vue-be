<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAllUser($request)
    {
        $user = Utils::search($this->user, $request);
        return  Utils::pagination($user, $request);
    }

    public function getUser($id)
    {
        return $this->user->findOrFail($id);
    }

    public function postUser($userInfo)
    {
        $user = new User;
        $userInfo['password'] = Hash::make($userInfo['password']);
        $userInfo['admin'] = 0;
        $user = $user->create($userInfo);
        return $this->user->findOrFail($user->id);
    }

    public function putUser($id, $userInfo)
    {
        $user = $this->user->findOrFail($id);
        if (array_key_exists('password', $userInfo)) {
            $userInfo['password'] = Hash::make($userInfo['password']);
        }
        $userInfo['admin'] = 0;
        $user->fill($userInfo)->save();
        $user = $this->user->findOrFail($id);
        return $user;
    }

    public function deleteUser($id)
    {
        $this->user->findOrFail($id)->delete();
        return true;
    }
}
