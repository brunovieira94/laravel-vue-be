<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskChangeEmailNotification;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    private $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function getAllTaskByUser($request)
    {
        $task = Utils::search($this->task, $request);
        return  Utils::pagination($task->where('user_id', Auth::user()->id), $request);
    }

    public function getTask($id)
    {
        return $this->task->with(['user'])->findOrFail($id);
    }

    public function postTask($taskInfo)
    {
        $task = new Task;
        $user = User::findOrFail(Auth::user()->id);
        $taskInfo['user_id'] = $user->id;
        $task = $task->create($taskInfo);
        $user->notify(new TaskChangeEmailNotification($user, $task, 'criada'));
        return $this->task->with(['user'])->findOrFail($task->id);
    }

    public function putTask($id, $taskInfo)
    {
        $task = $this->task->findOrFail($id);
        $user = User::findOrFail(Auth::user()->id);
        $task->fill($taskInfo)->save();
        $task = $this->task->with(['user'])->findOrFail($id);
        $user->notify(new TaskChangeEmailNotification($user, $task, 'atualizada'));
        return $task;
    }

    public function deleteTask($id)
    {
        $user = User::findOrFail(Auth::user()->id);
        $task = $this->task->findOrFail($id);
        $task->delete();
        $user->notify(new TaskChangeEmailNotification($user, $task, 'deletada'));
        return true;
    }
}
