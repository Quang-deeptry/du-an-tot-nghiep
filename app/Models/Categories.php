<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    protected $fillable = ['category', 'slug'];
    protected $casts = [
        'created_at' => 'datetime:d/m/Y', // Change your format
        'updated_at' => 'datetime:d/m/Y',
    ];

    public function news()
    {
        return $this->hasOne(\App\Models\News::class, 'category_id', 'id');
    }

    public function newCount()
    {
        return $this->hasMany('App\Models\News', 'category_id', 'id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'category'
            ]
        ];
    }
}