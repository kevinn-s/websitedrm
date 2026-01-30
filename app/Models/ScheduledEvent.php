<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduledEvent extends Model
{
    protected $table = 'scheduled_events';

    protected $fillable = [
        'event_id',
        'date',
        'start_at',
        'end_at',
        'location',
        'map_url',
        'meeting_url',
        'images',
    ];
    protected $casts = [
        'date' => 'date',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'images' => 'string'
    ];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
