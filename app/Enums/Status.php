<?php

namespace App\Enums;

enum Status: string
{
    case Pending = 'PENDING';
    case Verified = 'VERIFIED';
    case Rejected = 'REJECTED';

    public function isPending(): bool
    {
        return $this === self::Pending;
    }

    public function isVerified(): bool
    {
        return $this === self::Verified;
    }

    public function isRejected(): bool
    {
        return $this === self::Rejected;
    }

    /**
     * Get a user-friendly label for the status.
     */
    public function getLabel(): string
    {
        return match($this) {
            self::Pending => 'Pending',
            self::Verified => 'Verified',
            self::Rejected => 'Rejected',
        };
    }

    /**
     * Get badge color for Filament UI (optional).
     */
    public function getColor(): string
    {
        return match($this) {
            self::Pending => 'warning',
            self::Verified => 'success',
            self::Rejected => 'danger',
        };
    }
}