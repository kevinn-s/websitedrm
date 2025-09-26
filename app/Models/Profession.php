<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    //
    protected $fillable = [
        "alumni_id",
        "profession",
        "company",
        "city",
        "province"
    ];

    public function alumni(){
        $this->belongsTo(Alumni::class);
    }
}
