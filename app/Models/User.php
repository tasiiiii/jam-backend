<?php

namespace App\Models;

use DateTime;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property string        $first_name
 * @property string|null   $middle_name
 * @property string        $last_name
 * @property string        $email
 * @property DateTime|null $email_verified_at
 * @property string        $avatar
 * @property int           $status
 * @property string        $password
 */
class User extends Authenticatable
{}
