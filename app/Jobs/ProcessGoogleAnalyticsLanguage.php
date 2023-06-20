<?php

namespace App\Jobs;

use App\Models\GoogleAnalyticsLanguage;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Analytics\Period;

class ProcessGoogleAnalyticsLanguage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $period;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($days)
    {
        $this->period = Period::days($days);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $performQuery = \Analytics::performQuery($this->period, 'ga:users,ga:pageviews', [
            'dimensions' => 'ga:date,ga:language'
        ]);

        collect($performQuery['rows'] ?? [])->map(function ($row) {
            GoogleAnalyticsLanguage::updateOrCreate([
                'date' => Carbon::createFromFormat('Ymd', $row[0])->format('Y-m-d'),
                'name' => $row[1]
            ], [
                'visitors' => (int) $row[2],
                'pageviews' => (int) $row[3]
            ]);
        });
    }
}
