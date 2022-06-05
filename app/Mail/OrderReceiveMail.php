<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderReceiveMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $orderID;
    public $amount;

    public function __construct($orderID, $amount)
    {
        $this->orderId = $orderID;
        $this->amount  = $amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $orderID = $this->orderID;
        $amount  = $this->amount;
        return $this->view('email.order', compact('orderID', 'amount'))->subject('Regarding to Payment');
    }
}
