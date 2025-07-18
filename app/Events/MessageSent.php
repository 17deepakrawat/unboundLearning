<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $student_id;
    public $title;
    public $description;
    public $source_id;
    public $source;
    public $time;
    public $question_id;
    public $studentName;
    /**
     * Create a new event instance.
     */
    
    public function __construct($title,$description,$source_id,$source,$time,$question_id)
    {
        $this->student_id = Auth::guard('student')->user()->id;
        $this->title = $title;
        $this->description = $description;
        $this->source_id = $source_id;
        $this->source = $source;
        $this->time = $time;
        $this->question_id = $question_id;
        $this->studentName =Auth::guard('student')->user()->first_name.' '. Auth::guard('student')->user()->last_name;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel("question"),
        ];
    }
    
}
