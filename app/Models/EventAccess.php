<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventAccess extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'event_id',
        'type',
        'name',
        'address',
        'map_url',
        'meeting_url',
        'meeting_passcode',
    ];

    protected $casts = [
        'type' => EventAccessType::class,

    ];

    // Relationships
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Helpers
    public function isVirtual(): bool
    {
        return $this->type === EventAccessType::VIRTUAL;
    }

    public function isPhysical(): bool
    {
         return $this->type === EventAccessType::PHYSICAL;
    }

    public function isHybrid(): bool 
    {
        return $this->type === EventAccessType::HYBRID;
    }
}