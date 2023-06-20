<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    const BASE_IMAGE_PATH = '/images/base-image.png';
    const IMAGE_PATH = '/images/projects/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order',
        'name',
        'slug',
        'url',
        'image',
        'short_description',
        'description'
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

    public function getImagePathAttribute()
    {
        if ($this->image) {
            return self::IMAGE_PATH . $this->image;
        }
    }

    public function getImagePathWithTimestampAttribute()
    {
        if ($this->imagePath) {
            return $this->imagePath . '?' . strtotime($this->updated_at);
        }
    }
}
