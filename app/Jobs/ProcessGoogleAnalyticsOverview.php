<?php

namespace App\Jobs;

use App\Models\GoogleAnalyticsOverview;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Analytics\Period;

class ProcessGoogleAnalyticsOverview implements ShouldQueue
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
            'dimensions' => 'ga:date,ga:deviceCategory,ga:operatingSystem,ga:browser,ga:continent,ga:country,ga:city',
        ]);

        collect($performQuery['rows'] ?? [])->map(function ($row) {
            GoogleAnalyticsOverview::updateOrCreate([
                'date' => Carbon::createFromFormat('Ymd', $row[0])->format('Y-m-d'),
                'device_category' => $row[1],
                'operating_system' => $row[2],
                'browser' => $row[3],
                'continent' => $row[4],
                'country' => $row[5],
                'city' => $row[6]
            ], [
                'visitors' => (int) $row[7],
                'pageviews' => (int) $row[8]
            ]);
        });
    }
}
