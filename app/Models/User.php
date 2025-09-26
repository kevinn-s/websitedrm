<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'student_id',
        'email',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => Status::class,
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
    ];

    public function hasVerifiedAlumniInfo(): bool
    {
        return $this->status === \App\Models\Status::VERIFIED;
    }
    public function scopeSearchUserName($query, $name)
    {
        if (!empty($name)) {
            return $query->where('name', 'like', '%' . $name . '%');
        }

        return $query;
    }


    public function scopeFilterStatus($query, ?Status $status){
        if ($status) {
            return $query->where('status', $status);
        }
        return $query;
    }

    /**
     * Get the user's competency from alumni data.
     */
    public function getCompetencyAttribute()
    {
        return $this->alumni?->competency;
    }

    /**
     * Get the user's social media links from alumni data.
     */
    public function getSocialMediaLinksAttribute()
    {
        return $this->alumni?->social_media_links;
    }

    
    public function approve()
    {
        if($this->onOfficialAlumniData())
        {
            $this->status = Status::VERIFIED;
            if(!$this->education){
                $officialAlumni = OfficialAlumni::where("student_id_1", "LIKE", $this->student_id)->get();
                $this->alumni()->create(
                    [
                        "name" => $this->name,
                        "student_id" => $this->student_id,
                        "email" => $this->email,
                    ]
                )->education()->create([
                    "graduation_batch" => $officialAlumni->graduation_batch,
                    "legitimation_date" => $officialAlumni->legitimation_date
                ]);
            }
            return $this->save();
        } else {
            return false;
        }

    }
    public function reject()
    {
        $this->status = Status::REJECTED;
        return $this->save();
    }
    
    public function onOfficialAlumniData(){
        if(
            OfficialAlumni::where("student_id_1", "LIKE", $this->student_id)->exists() &&
            OfficialAlumni::where("name", $this->name)->exists()
        ){
            return true;
        }
        return false;
    }
    /**
     * Get the alumni information for this user.
     */
    public function alumni()
    {
        return $this->hasOne(Alumni::class, 'student_id', 'student_id');
    }
}
