<?php

namespace App\Enums;

enum EventType: string {
    case Annual = 'ANNUAL';
    case Scheduled = 'SCHEDULED';
}