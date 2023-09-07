<?php

namespace App\Http\Controllers;

use App\Http\Requests\PutUserRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->userService->getAllUser();
    }

    public function show($id)
    {
        return $this->userService->getUser($id);
    }

    public function store(StoreUserRequest $request)
    {
        return $this->userService->postUser($request->all());
    }

    public function update(PutUserRequest $request, $id)
    {
        return $this->userService->putUser($id, $request->all());
    }

    public function destroy($id)
    {
        $user = $this->userService->deleteUser($id);
        return response('');
    }
}
