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
     * A detail belongs to a user
     */
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
