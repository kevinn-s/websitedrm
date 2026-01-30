<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use App\Enums\EventCategory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Event extends Model
{
    use CrudTrait;
    use HasUlids;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'description',
    ];

    protected $hidden = ['id'];

    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'category' => EventCategory::class,
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function (Event $event) {
            $event->slug = strtolower(substr($event->id, -5)) . '-' . Str::slug($event->title);
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Relasi ke tabel detail
     */
    public function annualEvent(): HasOne
    {
        return $this->hasOne(AnnualEvent::class);
    }

       public function scheduledEvent(): HasOne
    {
        return $this->hasOne(ScheduledEvent::class);
    }
}
