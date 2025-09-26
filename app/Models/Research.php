<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Alumni;
class Research extends Model
{
    //
    protected $fillable = [
        'alumni_id',
        'title',
        'type',
        'publication_year',
        'publisher',
        'publication_link',
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id', 'id');
    }
}
