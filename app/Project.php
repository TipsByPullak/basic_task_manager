<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use App\Models\Concerns\UsesUuid;

    protected $guarded = []; // YOLO
}
