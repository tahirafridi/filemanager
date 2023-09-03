<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'name', 'value',
    ];
}
