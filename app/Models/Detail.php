<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $table = 'details';
    protected $primaryKey = 'id';
    protected $guarded = [];

    /**
     * A detail has many users
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'user_id', 'id');
    }
}
