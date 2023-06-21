<?php

namespace App\Jam\Team\Enum;

enum StatusEnum: int
{
    case NotActive = 1;
    case Active    = 2;
    case Banned    = 3;
}
