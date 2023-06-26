<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $title
 * @property string $description
 * @property float  $story_point
 * @property int    $creator_id
 * @property int    $executor_id
 * @property int    $board_column_id
 */
class Task extends Model
{}
