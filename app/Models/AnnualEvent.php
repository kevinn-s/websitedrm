<?php

namespace App\Models;
use App\Enums\EventAccess;
use Illuminate\Database\Eloquent\Model;

class AnnualEvent extends Model
{
    protected $table = 'annual_events';

    protected $fillable = [
        'event_id',
        'month',
        'type',
        'images',
    ];
    protected $casts = [
        'month' => 'date',
        'type' => EventAccess::class,
        'images' => 'array'
    ];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
