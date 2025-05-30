<?php

namespace App\Jobs;

use App\Mail\JobPostedNotification;
use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendJobPostedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Job */
    protected $job;

    /** @var string */
    protected $userEmail;

    /**
     * Create a new job instance.
     *
     * @param Job $job
     * @param string $userEmail
     */
    public function __construct(Job $job, $userEmail)
    {
        $this->job = $job;
        $this->userEmail = $userEmail;
    }

    /**
     * Execute the job.
     * Note: Do NOT add any arguments to this method!
     */
    public function handle()
    {
        Mail::to($this->userEmail)->send(new JobPostedNotification($this->job));
    }
}