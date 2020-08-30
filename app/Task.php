<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use App\Models\Concerns\UsesUuid;

    protected $guarded = []; // YOLO
}
