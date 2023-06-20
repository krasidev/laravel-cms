<?php

namespace App\Jobs;

use App\Models\GoogleAnalyticsBrowser;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Analytics\Period;

class ProcessGoogleAnalyticsBrowser implements ShouldQueue
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
            'dimensions' => 'ga:date,ga:browser,ga:browserVersion'
        ]);

        collect($performQuery['rows'] ?? [])->map(function ($row) {
            GoogleAnalyticsBrowser::updateOrCreate([
                'date' => Carbon::createFromFormat('Ymd', $row[0])->format('Y-m-d'),
                'name' => $row[1],
                'version' => $row[2]
            ], [
                'visitors' => (int) $row[3],
                'pageviews' => (int) $row[4]
            ]);
        });
    }
}
