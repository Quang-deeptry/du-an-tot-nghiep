<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime:d/m/Y', // Change your format
        'updated_at' => 'datetime:d/m/Y',
    ];

    public function user()
    {
        return $this->hasOne(\App\User::class, 'id', 'user_id');
    }

    public function news()
    {
        return $this->belongsTo(\App\Models\News::class);
    }
}