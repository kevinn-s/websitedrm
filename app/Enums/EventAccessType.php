<?php

namespace App\Enums;

enum EventAccessType: string {
    case VIRTUAL = 'VIRTUAL';
    case PHYSICAL = 'PHYSICAL';
    case HYBRID = 'HYBRID';
}