<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Folder extends Model
{
    protected $table = 'folders';

    protected $fillable = [
        'name'
    ];

    public static function search($columns, $search)
    {
        return empty($search) ? static::query()
            : static::query()->where(function ($query) use ($columns, $search) {
                foreach ($columns as $column) {
                    if ($column['search']) {
                        $query->orWhere($column['name'], 'like', "%$search%");
                    }
                }
            });
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
