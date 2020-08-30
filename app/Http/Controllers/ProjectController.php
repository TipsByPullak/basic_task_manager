<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use App\Models\Concerns\UsesUuid;

    protected $guarded = []; // YOLO
}
