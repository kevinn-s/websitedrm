<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function scopeSearchStudentName($query, $name)
    {
        if (!empty($name)) {
            return $query->where('student_name', 'like', '%' . $name . '%');
        }

        return $query;
    }

    public function scopeFilterLegitimationDate($query, String $startDate, String $endDate)
    {
        if($startDate) {
            if($endDate)
            {
                return $query->whereBetween('legitimation_date', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay(),
                ]);
            }
            return $query->where('legitimation_date', '>=', Carbon::parse($startDate)->startOfDay());
        }
        return $query;
    }

    public function scopeClearFilter($query){
        return $query;
    }
}
