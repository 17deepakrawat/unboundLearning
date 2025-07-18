<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMailOnOpportunity extends Mailable
{
  use Queueable, SerializesModels;

  public $student;
  /**
   * Create a new message instance.
   */
  public function __construct($student)
  {
    $this->student = $student;
  }

  /**
   * Get the message envelope.
   */
  public function build()
  {
    return $this->from(env('MAIL_FROM_ADDRESS'))
      ->subject('Welcome to Swayam Vidya')
      ->view('emails.welcome-mail-on-opportunity')
      ->with([
        'name' => $this->student['name'],
        'vertical' => $this->student['vertical'],
        'program' => $this->student['program'],
        'student_id' => $this->student['student_id'],
        'login_url' => 'https://swayamvidya.com/student/login',
      ]);
  }
}
