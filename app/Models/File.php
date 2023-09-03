<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Contracts\Database\Eloquent\Builder;

class File extends Model implements HasMedia
{
    use InteractsWithMedia;
    
    protected $table = 'files';

    protected $fillable = [
        'folder_id', 'name', 'secret'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('apk-files');
    }

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

    public function statistics()
    {
        return $this->hasMany(Statistic::class);
    }
}
