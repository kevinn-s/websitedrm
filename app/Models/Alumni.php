<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Jetstream\HasProfilePhoto;

class Alumni extends Model
{
    use HasFactory;
    use HasProfilePhoto;

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
        'competency' => 'json',

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

    public function getSocialMediaLinksAttribute()
    {
        $links = [];
        if ($this->x) {
            $links['twitter'] = 'https://twitter.com/' . $this->twitter;
        }
        if ($this->facebook) {
            $links['facebook'] = 'https://www.facebook.com/' . $this->instagram;
        }
        if ($this->instagram) {
            $links['instagram'] = 'https://www.instagram.com/' . $this->instagram;
        }
        if ($this->linkedin) {
            $links['linkedin'] = $this->linkedin;
        }
        return $links;
    }

public function scopeSearchAlumniName($query, $name)
{
    if (!empty($name)) {
        return $query->where('name', 'like', '%' . $name . '%');
    }

    return $query;
}


    public function scopeFilterGraduationBatch($query, ?string $graduation_batch)
    {
        if ($graduation_batch) {
            return $query->whereHas('education', function ($educationQuery) use ($graduation_batch) {
                $educationQuery->where('graduation_batch', $graduation_batch);
            });
        }
        return $query;
    }
    

    public function education(){
        return $this->hasOne(Education::class, "alumni_id");
    }

    public function research(){
        return $this->hasMany(Research::class, "alumni_id");
    }

    public function profession(){
        return $this->hasOne(Profession::class, "alumni_id");
    }

    /**
     * Get the user associated with this alumni record.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id', 'student_id');
    }

    public function onOfficialAlumniData(){
        if(
            OfficialAlumni::where("student_id_1", "LIKE", $this->student_id)->exists() &&
            OfficialAlumni::where("student_name", $this->name)->exists()
        ){
            return true;
        }
        return false;
    }
}
