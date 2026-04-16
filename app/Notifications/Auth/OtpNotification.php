<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OtpNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly string $code,
        private readonly string $channel,
    ) {}

    public function via(mixed $notifiable): array
    {
        return match ($this->channel) {
            'email' => ['mail'],
            'phone' => [], // SMS handled separately via OtpSenderService
            default => ['mail'],
        };
    }

    public function toMail(mixed $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('auth.otp_email_subject', ['app' => config('app.name')]))
            ->greeting(__('auth.otp_email_greeting'))
            ->line(__('auth.otp_email_body'))
            ->line("**{$this->code}**")
            ->line(__('auth.otp_email_expiry', ['minutes' => 5]))
            ->line(__('auth.otp_email_ignore'))
            ->salutation(' ');
    }
}
