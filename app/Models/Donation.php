<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


enum Status
{
    case PENDING;
    case VERIFIED;
    case REJECTED;
}

class Donation extends Model
{
    //
    protected $fillable = [
        "user_id",
        "student_id",
        "type",
        "amount",
        "payment_detail_photo_path",
        "status",
        "verified_at",
        "verified_by"
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'verified_at' => 'datetime',
    ];

        /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'type',
        'status',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'type',
        'status'
    ];

    public function isVerified(){
        return $this->status = Status::VERIFIED;
    }

    public function isPending(){
        return $this->status = Status::PENDING;
    }

    public function isRejected(){
        return $this->status = Status::REJECTED;
    }

    public function getFormattedNominalAttribute(): string {
        return 'Rp ' . number_format((float) $this->amount, 0, ',', '.');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
