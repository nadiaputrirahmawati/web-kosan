<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contract extends Model
{
    protected $table = 'contracts';

    protected $primaryKey = 'contract_id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'room_id',
        'owner_id',
        'user_id',
        'start_date',
        'end_date',
        'status',
        'signature',
        'deposit_amount',
        'deposit_status',
        'verification_contract',
        'rejection_feedback',
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

    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id', 'room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'contract_id', 'contract_id');
    }
}
