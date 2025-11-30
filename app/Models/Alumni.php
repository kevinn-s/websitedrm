<?php

namespace App\Models;

use Error;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

use App\Enums\Status;
class Alumni extends Authenticatable implements JWTSubject, CanResetPasswordContract
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, CanResetPassword;

    protected $table = 'alumni';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'nim',
        'email',
        'password',
        'status',
        'telepon',
        'nama_perusahaan',
        'posisi',
        'kota',
        'provinsi',
        'instagram',
        'linkedin',
        'twitter',
        'facebook'
    ];

    protected $hidden = ['password', 'nim', 'status'];

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
            'password' => 'hashed',
        ];
    }
    public function karyaIlmiah()
    {
        return $this->hasOne(KaryaIlmiah::class);
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

    // public function getEmailForPasswordReset() {
    //     if ($this->status->isVerified()) {
    //         return $this->email;
    //     } throw new \LogicException('Akun belum terverifikasi / akun ditolak');
    // }
}
