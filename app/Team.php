<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use App\Models\Concerns\UsesUuid;

    protected $guarded = []; // YOLO
}
