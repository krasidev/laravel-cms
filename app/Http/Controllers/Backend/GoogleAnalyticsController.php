<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessGoogleAnalyticsBrowser;
use App\Jobs\ProcessGoogleAnalyticsDeviceCategory;
use App\Jobs\ProcessGoogleAnalyticsLanguage;
use App\Jobs\ProcessGoogleAnalyticsLocation;
use App\Jobs\ProcessGoogleAnalyticsOperatingSystem;
use App\Jobs\ProcessGoogleAnalyticsUrl;
use App\Models\GoogleAnalyticsBrowser;
use App\Models\GoogleAnalyticsDeviceCategory;
use App\Models\GoogleAnalyticsLanguage;
use App\Models\GoogleAnalyticsLocation;
use App\Models\GoogleAnalyticsOperatingSystem;
use App\Models\GoogleAnalyticsUrl;
use Illuminate\Http\Request;

class GoogleAnalyticsController extends Controller
{
    protected $days;

    public function __construct()
    {
        $this->days = 2;
    }

    public function urls(Request $request)
    {
        if ($request->ajax()) {
            $urls = GoogleAnalyticsUrl::query();

            if ($request->get('path')) {
                $urls->where('path', $request->get('path'));
            }

            $startDate = $request->get('start_date') ?? $request->get('end_date');
            $endDate = $request->get('end_date') ?? $request->get('start_date');

            if ($startDate && $endDate) {
                $urls->whereBetween('date', [$startDate, $endDate]);
            }

            $urls->totalData();

            $datatable = datatables()->eloquent($urls);

            return $datatable->make(true);
        }

        $urls = GoogleAnalyticsUrl::distinct('path')->select('path')->get();

        return view('backend.google-analytics.urls', compact('urls'));
    }

    public function locations(Request $request)
    {
        if ($request->ajax()) {
            $locations = GoogleAnalyticsLocation::query();

            if ($request->get('continent')) {
                $locations->where('continent', $request->get('continent'));
            }

            $startDate = $request->get('start_date') ?? $request->get('end_date');
            $endDate = $request->get('end_date') ?? $request->get('start_date');

            if ($startDate && $endDate) {
                $locations->whereBetween('date', [$startDate, $endDate]);
            }

            $locations->totalData();

            $datatable = datatables()->eloquent($locations);

            return $datatable->make(true);
        }

        $locationContinents = GoogleAnalyticsLocation::distinct('continent')->select('continent')->get();

        return view('backend.google-analytics.locations', compact('locationContinents'));
    }

    public function languages(Request $request)
    {
        if ($request->ajax()) {
            $languages = GoogleAnalyticsLanguage::query();

            if ($request->get('name')) {
                $languages->where('name', $request->get('name'));
            }

            $startDate = $request->get('start_date') ?? $request->get('end_date');
            $endDate = $request->get('end_date') ?? $request->get('start_date');

            if ($startDate && $endDate) {
                $languages->whereBetween('date', [$startDate, $endDate]);
            }

            $languages->totalData();

            $datatable = datatables()->eloquent($languages);

            return $datatable->make(true);
        }

        $languages = GoogleAnalyticsLanguage::distinct('name')->select('name')->get();

        return view('backend.google-analytics.languages', compact('languages'));
    }

    public function browsers(Request $request)
    {
        if ($request->ajax()) {
            $browsers = GoogleAnalyticsBrowser::query();

            if ($request->get('name')) {
                $browsers->where('name', $request->get('name'));
            }

            $startDate = $request->get('start_date') ?? $request->get('end_date');
            $endDate = $request->get('end_date') ?? $request->get('start_date');

            if ($startDate && $endDate) {
                $browsers->whereBetween('date', [$startDate, $endDate]);
            }

            $browsers->totalData();

            $datatable = datatables()->eloquent($browsers);

            return $datatable->make(true);
        }

        $browsers = GoogleAnalyticsBrowser::distinct('name')->select('name')->get();

        return view('backend.google-analytics.browsers', compact('browsers'));
    }

    public function deviceCategories(Request $request)
    {
        if ($request->ajax()) {
            $deviceCategories = GoogleAnalyticsDeviceCategory::query();

            if ($request->get('name')) {
                $deviceCategories->where('name', $request->get('name'));
            }

            $startDate = $request->get('start_date') ?? $request->get('end_date');
            $endDate = $request->get('end_date') ?? $request->get('start_date');

            if ($startDate && $endDate) {
                $deviceCategories->whereBetween('date', [$startDate, $endDate]);
            }

            $deviceCategories->totalData();

            $datatable = datatables()->eloquent($deviceCategories);

            return $datatable->make(true);
        }

        $deviceCategories = GoogleAnalyticsDeviceCategory::distinct('name')->select('name')->get();

        return view('backend.google-analytics.device-categories', compact('deviceCategories'));
    }

    public function operatingSystems(Request $request)
    {
        if ($request->ajax()) {
            $operatingSystems = GoogleAnalyticsOperatingSystem::query();

            if ($request->get('name')) {
                $operatingSystems->where('name', $request->get('name'));
            }

            $startDate = $request->get('start_date') ?? $request->get('end_date');
            $endDate = $request->get('end_date') ?? $request->get('start_date');

            if ($startDate && $endDate) {
                $operatingSystems->whereBetween('date', [$startDate, $endDate]);
            }

            $operatingSystems->totalData();

            $datatable = datatables()->eloquent($operatingSystems);

            return $datatable->make(true);
        }

        $operatingSystems = GoogleAnalyticsOperatingSystem::distinct('name')->select('name')->get();

        return view('backend.google-analytics.operating-systems', compact('operatingSystems'));
    }

    public function syncUrls()
    {
        dispatch(new ProcessGoogleAnalyticsUrl($this->days));

        return redirect()->route('backend.google-analytics.urls')
            ->with('success', [
                'title' => __('messages.backend.google-analytics.sync_success.title'),
                'text' => __('messages.backend.google-analytics.sync_success.text')
            ]);
    }

    public function syncLocations()
    {
        dispatch(new ProcessGoogleAnalyticsLocation($this->days));

        return redirect()->route('backend.google-analytics.locations')
            ->with('success', [
                'title' => __('messages.backend.google-analytics.sync_success.title'),
                'text' => __('messages.backend.google-analytics.sync_success.text')
            ]);
    }

    public function syncLanguages()
    {
        dispatch(new ProcessGoogleAnalyticsLanguage($this->days));

        return redirect()->route('backend.google-analytics.languages')
            ->with('success', [
                'title' => __('messages.backend.google-analytics.sync_success.title'),
                'text' => __('messages.backend.google-analytics.sync_success.text')
            ]);
    }

    public function syncBrowsers()
    {
        dispatch(new ProcessGoogleAnalyticsBrowser($this->days));

        return redirect()->route('backend.google-analytics.browsers')
            ->with('success', [
                'title' => __('messages.backend.google-analytics.sync_success.title'),
                'text' => __('messages.backend.google-analytics.sync_success.text')
            ]);
    }

    public function syncDeviceCategories()
    {
        dispatch(new ProcessGoogleAnalyticsDeviceCategory($this->days));

        return redirect()->route('backend.google-analytics.device-categories')
            ->with('success', [
                'title' => __('messages.backend.google-analytics.sync_success.title'),
                'text' => __('messages.backend.google-analytics.sync_success.text')
            ]);
    }

    public function syncOperatingSystems()
    {
        dispatch(new ProcessGoogleAnalyticsOperatingSystem($this->days));

        return redirect()->route('backend.google-analytics.operating-systems')
            ->with('success', [
                'title' => __('messages.backend.google-analytics.sync_success.title'),
                'text' => __('messages.backend.google-analytics.sync_success.text')
            ]);
    }
}
