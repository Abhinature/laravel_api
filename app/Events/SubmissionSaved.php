<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Submission;

class SubmissionSaved
{
    use Dispatchable, SerializesModels;

    public $submission;

    /**
     * Create a new event instance.
     */
    

     public function __construct(Submission $submission)
     {
         $this->submission = $submission;
     }

   
}
