<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SellerResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $user;
    public $resetUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($token, User $user)
    {
        $this->token = $token;
        $this->user = $user;
        $this->resetUrl = route('seller.password.reset', ['token' => $token, 'email' => $user->email]);
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Réinitialisation de votre mot de passe vendeur - Kondo Market')
                    ->markdown('emails.seller.reset-password')
                    ->with([
                        'token' => $this->token,
                        'user' => $this->user,
                        'resetUrl' => $this->resetUrl,
                        'expires' => now()->addHour()->format('d/m/Y à H:i'),
                    ]);
    }
}