<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Entities\News;
use Illuminate\Support\Facades\Queue;
use \Carbon\Carbon;
use App\Entities\Statistic;

class UpdateViewsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $tries = 3;
    private $news;
    public function __construct(News $news)
    {
        $this->news = $news;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $now = Carbon::now()->format('Ymd');
        $statistic = $this->news->statistics()->where('day_id', $now)->whereName(Statistic::COUNT_VIEWS)->first();
        if ($statistic) {
            $statistic->value += cache()->get($this->news->slug);
            $statistic->save();
        } else {
            $this->news->statistics()->create([
                'day_id' => $now,
                'name' => Statistic::COUNT_VIEWS,
                'value' => cache()->get($this->news->slug)
            ]);
        }
        cache()->forget($this->news->slug);
    }
}
