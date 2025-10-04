<?php

namespace App\Models;
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
        'event_date',
        'event_time',
        'annual_month',
        'speaker_name',
        'description',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'event_date'   => 'date',
        'type' => EventType::class
    ];

    // Relationships
    public function accesses()
    {
        return $this->hasMany(EventAccess::class);
    }

    public function registrants()
    {
        return $this->belongsToMany(
            User::class,
            'event_registrations'
        )->withTimestamps()->withPivot('status', 'registered_at');
    }

        public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if ($search) {
            return $query->where('title', 'like', "%{$search}%");
        }
        return $query;
    }

    /**
     * Scope a query to filter by event type: 'scheduled' (upcoming) or 'annual'.
     */
public function scopeOfType(Builder $query, ?EventType $type): Builder
{
    if ($type instanceof EventType) {
        return $query->where('type', $type->value);
    }
    return $query;
}

    /**
     * Scope a query to get only scheduled (upcoming) events that haven't passed.
     * Optional: you can add date filtering here if needed.
     */
    public function scopeScheduled(Builder $query): Builder
    {
        return $query->where('type', EventType::SCHEDULED);
    }

    /**
     * Scope a query to get only annual events.
     */
    public function scopeAnnual(Builder $query): Builder
    {
        return $query->where('type', EventType::ANNUAL);
    }
    // Helpers
    public function getFormatAttribute()
    {
        $types = $this->accesses->pluck('type')->toArray();
        if (in_array('in_person', $types) && in_array('virtual', $types)) {
            return 'hybrid';
        }
        return $types[0] ?? 'in_person';
    }

    public function inPersonAccess()
    {
        return $this->accesses->firstWhere('type', 'in_person');
    }

    public function virtualAccess()
    {
        return $this->accesses->firstWhere('type', 'virtual');
    }
}