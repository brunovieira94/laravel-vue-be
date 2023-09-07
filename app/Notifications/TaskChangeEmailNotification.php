<?php

namespace App\Notifications;

use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskChangeEmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $user;
    private $task;
    private $action;
    public function __construct(User $user, Task $task, $action)
    {
        $this->user = $user;
        $this->task = $task;
        $this->action = $action;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Olá, '.$this->user->name)
            ->line('A tarefa '.$this->task->id.' - '.$this->task->title.' foi '.$this->action);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
