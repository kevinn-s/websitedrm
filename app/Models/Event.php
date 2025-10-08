<?php

namespace App\Models;
use App\Enums\EventType;
use App\Enums\EventAccessType;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'category',
        'type',
        'published_at',
        'date',
        'time',
        'annual_date',
        'speaker_name',
        'description',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'event_date' => 'date',
        'type' => EventType::class
    ];

    public function getRouteKeyName()
    {
        return 'title';
    }

    // Specific relationships

    // Relationships
    public function accesses()
    {
        return $this->hasOne(EventAccess::class);
    }

}