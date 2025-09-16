<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $qrCodeUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($booking, $qrCodeUrl)
    {
        $this->booking = $booking;
        $this->qrCodeUrl = $qrCodeUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Booking Confirmation')
                    ->view('emails.booking-confirmation');
    }
}
