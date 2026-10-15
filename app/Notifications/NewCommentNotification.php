<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Comment $comment
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nuevo comentario en una publicación')
            ->greeting('¡Hola!')
            ->line('Se ha publicado un nuevo comentario.')
            ->line('Autor: ' . $this->comment->author)
            ->line('Comentario: ' . $this->comment->content)
            ->line('Publicación: ' . $this->comment->post->title);
    }
}
