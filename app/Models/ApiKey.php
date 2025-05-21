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

    protected static function boot()
    {
        parent::boot();

        // Génère une clé aléatoire automatiquement si vide
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
            $model->key = Str::random(40);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}