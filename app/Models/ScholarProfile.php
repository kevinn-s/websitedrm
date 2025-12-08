<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ScholarProfile extends Model
{
    use HasFactory;

    protected $table = 'scholar_profiles';

    protected $fillable = [
        'gs_profile_id',
        'name',
        'affiliation',
        'citation_count',
        'h_index',
        'i10_index',
        'profile_photo_url',
        'last_synced_at',
    ];

    protected $casts = [
        'citation_count' => 'integer',
        'h_index' => 'integer',
        'i10_index' => 'integer',
        'last_synced_at' => 'datetime',
    ];
    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }
}
