<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Illuminate\Notifications\Notifiable;

use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

use App\Enums\Status;
use App\Notifications\ResetPasswordNotification;

use Error;
use Str;
class Alumni extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'alumni';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nim',
        'email',
        'password',
        'status',
        'bib',
        'phone',
        'instagram',
        'linkedin',
        'x',
        'facebook',
        'image'
    ];

    protected $hidden = ['password', 'status'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => Status::class,
            'email_verified_at' => 'datetime',
            'slug' => 'string'
        ];
    }

    public function activity()
    {
        return $this->hasOne(Activity::class);
    }
    public function scholarProfile()
    {
        return $this->hasOne(ScholarProfile::class);
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    public function profession()
    {
        return $this->hasOne(Profession::class);
    }


    public function setNameAttribute($value)
    {
        // WARNING!!! DO NOT EXPLICITLY CALLED THE COLUMN AS IT WILL PRODUCE RECURSIONS
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getSocialLinksAttribute()
    {
        return [
            'instagram' => $this->instagram ? 'https://instagram.com/' . ltrim($this->instagram, '@') : null,
            'linkedin' => $this->linkedin ? 'https://linkedin.com/in/' . $this->linkedin : null,
            'twitter' => $this->twitter ? 'https://twitter.com/' . ltrim($this->twitter, '@') : null,
            'facebook' => $this->facebook ? 'https://facebook.com/' . $this->facebook : null,
        ];
    }
    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    #[Scope]
    protected function verified(Builder $query): void
    {
        $query->where('status', Status::VERIFIED);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

}
