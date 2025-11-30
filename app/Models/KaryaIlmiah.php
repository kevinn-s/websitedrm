<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KaryaIlmiah extends Model
{
     use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'karya_ilmiah';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'alumni_id',
        'judul',
        'jenis',
        'tahun',
        'tautan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tahun' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the alumni that owns the scientific work.
     */
    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}
