<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Payment extends Model
{
    protected $table = 'payments';

    protected $primaryKey = 'payment_id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'contract_id',
        'amount',
        'status',
        'payment_date',
        'snap_token',
        'order_id',
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
