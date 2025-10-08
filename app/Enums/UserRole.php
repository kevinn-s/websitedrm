<?php

namespace App\Enums;

enum UserRole: string
{
    case Alumni = 'ALUMNI';
    case Admin = 'ADMIN';

    /**
     * Get all role values as array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get all role names as array
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Get label for display
     */
    public function label(): string
    {
        return match($this) {
            self::Alumni => 'Alumni',
            self::Admin => 'Admin',
        };
    }

    /**
     * Check if role is admin
     */
    public function isAdmin(): bool
    {
        return $this === self::Admin;
    }

    /**
     * Check if role is alumni
     */
    public function isAlumni(): bool
    {
        return $this === self::Alumni;
    }

    /**
     * Get array for select options
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($role) => [$role->value => $role->label()])
            ->toArray();
    }
}