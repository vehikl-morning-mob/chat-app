<?php

namespace App\Jobs;

use App\User;
use App\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CombatLonelinessJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(?User $user = null)
    {
        $this->user = $user ?? factory(User::class)->create(['name' => 'Loneliness Bot']);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        factory(Message::class)->create(["user_id" => $this->user->id]);

        CombatLonelinessJob::dispatch($this->user)
            ->delay(random_int(2, 5));
    }
}
