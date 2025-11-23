<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{

    protected $table = "profession";
    //
    protected $fillable = [
        "alumni_id",
        "profession",
        "company",
        "city",
        "province"
    ];

    public function alumni(){
        return $this->belongsTo(Alumni::class);
    }
}
