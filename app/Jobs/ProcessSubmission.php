<?php

namespace App\Jobs;

use App\Models\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

     protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
           // Save the data to the database
        $submission = new Submission();
        $submission->name = $this->data['name'];
        $submission->email = $this->data['email'];
        $submission->message = $this->data['message'];
        $submission->save();

        // Trigger the event
        event(new \App\Events\SubmissionSaved($submission));
        } catch (\Exception $e) {
            // Handle any errors that occur during processing
            Log::error('Error processing submission: ' . $e->getMessage());
        }
    }
}
