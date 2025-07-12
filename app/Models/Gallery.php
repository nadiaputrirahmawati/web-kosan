<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    protected $table = 'galleries';

    protected $primaryKey = 'gallery_id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'gallery_id',
        'room_id',
        'image_url',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
