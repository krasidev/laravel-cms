<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GoogleAnalyticsDeviceCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'name',
        'visitors',
        'pageviews'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'datetime',
    ];

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format(config('system.datetime_format'));
    }

    /**
     * Scope a query return summary by date.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSummaryByDate($query)
    {
        return $query->select([
            'date AS categories',
            DB::raw('SUM(visitors) as visitors'),
            DB::raw('SUM(pageviews) as pageviews')
        ])->groupBy('date');
    }

    /**
     * Scope a query return total data.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTotalData($query)
    {
        return $query->select([
            'name',
            DB::raw('SUM(visitors) as visitors'),
            DB::raw('SUM(pageviews) as pageviews')
        ])->groupBy('name');
    }
}
