<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        'bio',
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


    public function education(){
        return $this->hasOne(Education::class);
    }

    public function research(){
        return $this->hasMany(Research::class);
    }

    public function profession(){
        return $this->hasOne(Profession::class);
    }

    public function getProfilePhotoUrlAttribute(): string
    {
        $path = $this->profile_photo_path;

        if (! filled($path)) {
            return asset('images/placeholder.png');
        }

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        $normalized = ltrim($path, '/');

        if (str_starts_with($normalized, 'storage/')) {
            $normalized = substr($normalized, strlen('storage/')) ?: '';
        }

        if ($normalized === '') {
            return asset('images/placeholder.png');
        }

        $publicPath = Storage::disk('public')->exists($normalized)
            ? Storage::url($normalized)
            : '/storage/' . ltrim($normalized, '/');

        if (str_starts_with($publicPath, 'http')) {
            $publicPath = parse_url($publicPath, PHP_URL_PATH) ?: '/storage/' . ltrim($normalized, '/');
        }

        // Prefer the current request host (so ports like :8000 are respected) and fall back to app URL.
        if (function_exists('request') && ($request = request()) && $request->getSchemeAndHttpHost()) {
            return rtrim($request->getSchemeAndHttpHost(), '/') . '/' . ltrim($publicPath, '/');
        }

        return url($publicPath);
    }

    /**
     * Get the user associated with this alumni record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
