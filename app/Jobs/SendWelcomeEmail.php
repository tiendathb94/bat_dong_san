<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\User;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

     private $user;

    public function __construct( User $user )
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = array(
            'email'=> $this->user->email,
            'remember_token'=> $this->user->remember_token,
        );
        Mail::send('templateEmail.welcome', ['data' => $data] , function($message) {
            $message->from('test1@gmail.com', 'Dũng Virgo');
            $message->to($this->user->email)->subject('Xác thực tài khoản');
        });
    }
}
