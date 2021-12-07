<?php

namespace App\Mail;

use App\Models\Cake;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CakeMail extends Mailable
{
    use Queueable, SerializesModels;

    private $cakeName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Cake $cake)
    {
        $this->cakeName = $cake->name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('salles@happycake.com', 'HappyCake')
            ->subject('Novidades na HappyCake')
            ->markdown('cake')
            ->with([
                'name' => $this->cakeName
            ]);
    }
}
