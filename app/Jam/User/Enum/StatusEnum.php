<?php

namespace App\Jam\User\Enum;

enum StatusEnum: int
{
    case NotActive = 1;
    case Active    = 2;
    case Banned    = 3;
}
