<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name'];
    protected $casts = [
        'created_at' => 'datetime:d/m/Y', // Change your format
        'updated_at' => 'datetime:d/m/Y',
    ];


    public function user()
    {
        return $this->hasOne(\App\User::class, 'role', 'id');
    }
}