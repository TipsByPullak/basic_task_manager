<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    use App\Models\Concerns\UsesUuid;

    protected $guarded = []; // YOLO
}
