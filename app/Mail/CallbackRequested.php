<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class CallbackRequested extends Mailable
{
    use Queueable, SerializesModels;


    protected $name;
    protected $phone;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        //
        $this->name = $request->name;
        $this->phone = $request->phone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@smpd.lv')->subject('Pasūtīts jauns zvans')->view('mail.callback')->with(['name' => $this->name, 'phone' => $this->phone]);
    }
}
