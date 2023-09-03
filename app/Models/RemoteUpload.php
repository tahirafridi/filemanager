<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;

class RemoteUpload extends Model
{
    protected $table = 'remote_uploads';

    protected $fillable = [
        'folder_id', 'url', 'status',
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

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
