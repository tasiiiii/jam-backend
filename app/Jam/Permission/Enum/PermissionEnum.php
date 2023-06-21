<?php

namespace App\Jam\Permission\Enum;

enum PermissionEnum: string
{
    case GOD_MODE = 'GOD_MODE';
    case ADMIN    = 'ADMIN';
    case MANAGER  = 'MANAGER';
    case USER     = 'USER';
    case GUEST    = 'GUEST';
}
