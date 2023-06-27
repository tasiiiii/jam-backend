<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int         $id
 * @property string      $title
 * @property string      $code
 * @property string|null $description
 * @property float|null  $story_point
 * @property int         $creator_id
 * @property int|null    $executor_id
 * @property int|null    $board_column_id
 * @property int         $board_id
 */
class Task extends Model
{}
