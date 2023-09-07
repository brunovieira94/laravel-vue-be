<?php

namespace App\Http\Controllers;

use App\Http\Requests\PutTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Http\Request;
use App\Services\TaskService;

class TaskController extends Controller
{
    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        return $this->taskService->getAllTaskByUser();
    }

    public function show($id)
    {
        return $this->taskService->getTask($id);
    }

    public function store(StoreTaskRequest $request)
    {
        return $this->taskService->postTask($request->all());
    }

    public function update(PutTaskRequest $request, $id)
    {
        return $this->taskService->putTask($id, $request->all());
    }

    public function destroy($id)
    {
        $task = $this->taskService->deleteTask($id);
        return response('');
    }
}
