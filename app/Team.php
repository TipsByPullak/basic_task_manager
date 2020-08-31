<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use Models\Concerns\UsesUuid;

    protected $guarded = []; // YOLO

    const CREATED_AT = null;
    const UPDATED_AT = null;
}
