<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use App\Models\Concerns\UsesUuid;

    protected $guarded = []; // YOLO
}
