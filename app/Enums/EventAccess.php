<?php

namespace App\Enums;

enum EventAccess: string
{

    case ONSITE = 'ONSITE';
    case ONLINE = 'ONLINE';
    case HYBRID = 'HYBRID';

    public function label(): string
    {
        return match($this) {
            self::ONSITE => 'Onsite',
            self::ONLINE => 'Online',
            self::HYBRID => 'Hybrid',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->pluck('label', 'value')->toArray();
    }
}
