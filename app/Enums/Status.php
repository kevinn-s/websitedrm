<?php

namespace App\Enums;

enum Status: string
{
    //
    case PENDING = 'PENDING';
    case VERIFIED = 'VERIFIED';
    case REJECTED = 'REJECTED';
        public function isPending(): bool
    {
        return $this === self::PENDING;
    }

    public function isVerified(): bool
    {
        return $this === self::VERIFIED;
    }

    public function isRejected(): bool
    {
        return $this === self::REJECTED;
    }
}
