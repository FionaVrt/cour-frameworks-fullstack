<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class ApiKey extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'name',
        'key',
    ];

    // Casts (facultatif, mais recommandé si tu veux forcer les types)
    protected $casts = [
        'uuid' => 'string',
        'user_id' => 'integer',
        'name' => 'string',
        'key' => 'string',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }

            if (empty($model->key)) {
                $model->key = Str::random(40);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
