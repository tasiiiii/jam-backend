<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as IlluminateController;

/**
 * @OA\Info(title="Jam", version="0.0.1")
 * @OA\PathItem(path="/")
 */
class BaseController extends IlluminateController
{
    use AuthorizesRequests, ValidatesRequests;
}
