<?php

namespace App\Models;

enum EventAccessType: string {
    case VIRTUAL = 'VIRTUAL';
    case PHYSICAL = 'PHYSICAL';
    case HYBRID = 'HYBRID';
}