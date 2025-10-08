<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;


    protected $table = "alumni";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'student_id',
        'email',
        'phone_number',
        'profile_photo_path',
        'competency',
        'x',
        'instagram',
        'facebook',
        'linkedin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // No sensitive auth data in alumni model
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'competency' => 'array',

    ];

    protected $allowedFilters = [
        'name',
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'social_media_links'
    ];

    /**
     * Get the social media links as an array.
     *
     * @return array
     */
    public function getSocialMediaLinksAttribute()
    {
        return [
            'x' => $this->x,
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'linkedin' => $this->linkedin,
        ];
    }

    public function scopeSearchAlumniName($query, $name)
    {
        if (!empty($name)) {
            return $query->where('name', 'like', '%' . $name . '%');
        }

        return $query;
    }


    public function scopeFilterGraduationBatch($query, ?string $graduationBatch)
    {
        if ($graduationBatch) {
            return $query->whereHas('education', function ($query) use ($graduationBatch) {
                $query->where('graduationBatch', $graduationBatch);
            });
        }
        return $query;
    }

    public function viewAny(){
        return true;
    }
    

    // public function education(){
    //     return $this->hasOne(Education::class, "alumni_id");
    // }

    // public function research(){
    //     return $this->hasMany(Research::class, "alumni_id");
    // }

    // public function profession(){
    //     return $this->hasOne(Profession::class, "alumni_id");
    // }

    /**
     * Get the user associated with this alumni record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
