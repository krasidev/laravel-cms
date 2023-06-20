<?php

namespace Database\Seeders;

use App\Models\GoogleAnalyticsBrowser;
use App\Models\GoogleAnalyticsDeviceCategory;
use App\Models\GoogleAnalyticsLanguage;
use App\Models\GoogleAnalyticsLocation;
use App\Models\GoogleAnalyticsOperatingSystem;
use App\Models\GoogleAnalyticsUrl;
use App\Models\Project;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;

class GoogleAnalyticsSeeder extends Seeder
{
    const SUB_DAYS = 10;

    const LOCATIONS = [
        [
            'continent' => 'Europe',
            'country' => 'Bulgaria',
            'city' => '(not set)'
        ], [
            'continent' => 'Europe',
            'country' => 'Bulgaria',
            'city' => 'Sofia'
        ], [
            'continent' => 'Europe',
            'country' => 'Ireland',
            'city' => 'Dublin'
        ]
    ];

    const LANGUAGES = [
        [
            'name' => 'bg'
        ], [
            'name' => 'bg-bg'
        ], [
            'name' => 'en-us'
        ]
    ];

    const BROWSERS = [
        [
            'name' => 'Firefox',
            'version' => '114.0'
        ], [
            'name' => 'Chrome',
            'version' => '114.0.0.0'
        ], [
            'name' => 'Internet Explorer',
            'version' => '11.0'
        ], [
            'name' => 'Edge',
            'version' => '114.0.1823.51'
        ]
    ];

    const DEVICE_CATEGORIES = [
        [
            'name' => 'desktop'
        ], [
            'name' => 'mobile'
        ]
    ];

    const OPERATING_SYSTEMS = [
        [
            'name' => 'Windows',
            'version' => '10'
        ], [
            'name' => 'Windows',
            'version' => '7'
        ], [
            'name' => 'Linux',
            'version' => 'x86_64'
        ], [
            'name' => 'Android',
            'version' => '7.1.1'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = Project::all();

        if ($projects->isNotEmpty()) {
            $data = [];
            $startDate = Carbon::now()->subDays(self::SUB_DAYS)->format('Y-m-d');
            $endDate = Carbon::now()->format('Y-m-d');
            $period = CarbonPeriod::create($startDate, $endDate);
            $countLocations = count(self::LOCATIONS) - 1;
            $countLanguages = count(self::LANGUAGES) - 1;
            $countBrowsers = count(self::BROWSERS) - 1;
            $countDeviceCategories = count(self::DEVICE_CATEGORIES) - 1;
            $countOperatingSystems = count(self::OPERATING_SYSTEMS) - 1;

            foreach ($period as $date) {
                $date = $date->format('Y-m-d');

                foreach ($projects as $project) {
                    $data[] = [
                        'date' => $date,
                        'path' => route('frontend.projects.show', ['project' => $project->slug], false),
                        'title' => $project->name,
                        'visitors' => rand(1, 5),
                        'pageviews' => rand(10, 20)
                    ];
                }
            }

            foreach ($data as $single) {
                $location = self::LOCATIONS[rand(0, $countLocations)];
                $language = self::LANGUAGES[rand(0, $countLanguages)];
                $browser = self::BROWSERS[rand(0, $countBrowsers)];
                $deviceCategory = self::DEVICE_CATEGORIES[rand(0, $countDeviceCategories)];
                $operatingSystem = self::OPERATING_SYSTEMS[rand(0, $countOperatingSystems)];

                GoogleAnalyticsUrl::updateOrCreate([
                    'date' => $single['date'],
                    'path' => $single['path'],
                    'title' => $single['title']
                ], [
                    'visitors' => $single['visitors'],
                    'pageviews' => $single['pageviews']
                ]);

                GoogleAnalyticsLocation::updateOrCreate([
                    'date' => $single['date'],
                    'continent' => $location['continent'],
                    'country' => $location['country'],
                    'city' => $location['city']
                ], [
                    'visitors' => $single['visitors'],
                    'pageviews' => $single['pageviews']
                ]);

                GoogleAnalyticsLanguage::updateOrCreate([
                    'date' => $single['date'],
                    'name' => $language['name']
                ], [
                    'visitors' => $single['visitors'],
                    'pageviews' => $single['pageviews']
                ]);

                GoogleAnalyticsBrowser::updateOrCreate([
                    'date' => $single['date'],
                    'name' => $browser['name'],
                    'version' => $browser['version']
                ], [
                    'visitors' => $single['visitors'],
                    'pageviews' => $single['pageviews']
                ]);

                GoogleAnalyticsDeviceCategory::updateOrCreate([
                    'date' => $single['date'],
                    'name' => $deviceCategory['name'],
                ], [
                    'visitors' => $single['visitors'],
                    'pageviews' => $single['pageviews']
                ]);

                GoogleAnalyticsOperatingSystem::updateOrCreate([
                    'date' => $single['date'],
                    'name' => $operatingSystem['name'],
                    'version' => $operatingSystem['version']
                ], [
                    'visitors' => $single['visitors'],
                    'pageviews' => $single['pageviews']
                ]);
            }
        }
    }
}
