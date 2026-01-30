<?php

namespace App\Enums;

enum EventCategory: string
{
    case ANNUAL = 'annual';
    case REGULAR = 'regular';

    /**
     * Mendapatkan label yang manusiawi (untuk UI)
     */
    public function label(): string
    {
        return match($this) {
            self::ANNUAL => 'Kegiatan Tahunan',
            self::REGULAR => 'Kegiatan Reguler',
        };
    }

    /**
     * Helper untuk kebutuhan dropdown di Laravel Backpack
     */
    public static function options(): array
    {
        return collect(self::cases())->pluck('label', 'value')->toArray();
    }

    /**
     * Helper untuk styling warna di Frontend (Opsional)
     */
    public function color(): string
    {
        return match($this) {
            self::ANNUAL => 'gold',
            self::REGULAR => 'blue',
        };
    }
}
