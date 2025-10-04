<?php

namespace App\Models;

enum EventType: string {
    case ANNUAL = 'ANNUAL';
    case SCHEDULED = 'SCHEDULED';
}