<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        "gpa",
        "graduation_batch",
        "legitimation_date"
    ];

    protected $allowedFilters = [
        'graduation_batch',
        'legitimation_date',
    ];

    public function alumni(){
        return $this->belongsTo(Alumni::class);
    }
}
