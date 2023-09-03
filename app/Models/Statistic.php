<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Statistic extends Model
{
    protected $table = 'statistics';

    protected $fillable = [
        'file_id', 'signed_minutes', 'signed_url', 'ip',
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

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
