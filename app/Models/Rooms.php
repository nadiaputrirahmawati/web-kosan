<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Rooms extends Model
{
    protected $table = 'rooms';

    protected $primaryKey = 'room_id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'room_id',
        'owner_id',
        'name',
        'total_rooms',
        'occupied_rooms',
        'type',
        'price',
        'deposit_amount',
        'public_facility',
        'room_facility',
        'regulation',
        'address',
        'description',
    ];

    protected $casts = [
        'regulation'       => 'array',
        'room_facility'    => 'array',
        'public_facility'  => 'array',
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

    // Rooms.php
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'room_id', 'room_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'user_id');
    }
}
