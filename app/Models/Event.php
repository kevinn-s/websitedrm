<?php

namespace App\Models;
use App\Enums\EventType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'tags',
        'type',
        'published_at',
        'date',
        'start_time',
        'end_time',
        'description',
        'registration_link'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'type' => EventType::class,
        'tags' => 'array'
    ];

    public function getRouteKeyName()
    {
        return 'title';
    }

    public function formattedTimeRange(): string|null
    {
        if(empty($this->start_time) || empty($this->end_time)){
            return null;
        }

        return $this->start_time->format('H:i') . ' - ' . $this->end_time->format('H:i');
    }

    public function accesses()
    {
        return $this->hasOne(EventAccess::class);
    }

}
