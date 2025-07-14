<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Withdrawal extends Model
{
    protected $table = 'withdrawals';

    protected $primaryKey = 'withdrawal_id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'owner_id',
        'amout',
        'proof',
        'status',
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

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'user_id');
    }
}
