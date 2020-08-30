<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    use App\Models\Concerns\UsesUuid;

    protected $guarded = []; // YOLO
}
