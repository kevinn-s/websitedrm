<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficialAlumni extends Model
{
    //
    protected $table = "official_alumni";

    protected $fillable = [
        'graduation_batch',
        'binusian_id',
        'student_id_1',
        'student_name',
        'legitimation_date'
    ];

    protected $casts = [
        'legitimation_date' => 'datetime',
    ];

    protected $allowedFilters = [
        'graduation_batch',
        'legitimation_date',
    ];

}
