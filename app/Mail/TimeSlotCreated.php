<?php

namespace App\Mail;

use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TimeSlotCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected $schedule;
    protected $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Schedule $schedule, $name)
    {
        $this->schedule = $schedule;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.timeSlotCreated')
        ->with([
            'date' => $this->schedule->work_day,
            'time' => $this->schedule->work_time,
            'name' => $this->name
        ])
        ->subject('Подтверждение создание новой записи');
    }
}
