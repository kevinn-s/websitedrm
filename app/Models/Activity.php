<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumni_id',
        'event_id',
    ];
    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
