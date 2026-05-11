<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailCustom extends VerifyEmailBase
{
    public function toMail($notifiable): MailMessage
    {
        $displayName = trim((string) ($notifiable->first_name ?: $notifiable->name));
        $appName = config('app.name', 'Studio Legale');
        $viewData = [
            'verificationUrl' => $this->verificationUrl($notifiable),
            'displayName' => $displayName !== '' ? $displayName : 'Cliente',
            'appName' => $appName,
            'expiresInMinutes' => (int) config('auth.verification.expire', 60),
        ];

        return (new MailMessage)
            ->subject('Conferma la tua registrazione - Studi Legali Consorziati')
            ->view('emails.auth.verify-email', $viewData)
            ->text('emails.auth.verify-email-text', $viewData);
    }
}
