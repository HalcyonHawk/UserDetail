<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\UserSavedEvent;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return $this->firstname . " " . $this->MiddleInitial . ". " . $this->lastname;
    }

    public function getMiddleInitialAttribute()
    {
        return substr($user->middlename, 0, 1);
    }

    public function getAvatarAttribute()
    {
        return $this->photo ?? "http://localhost/noimage.png";
    }

    public function getGenderAttribute()
    {
        return $this->prefixname === "Mr." ? "Male" : "Female";
    }

    /**
     * A user has many details
     */
    public function detail()
    {
        return $this->hasMany('App\Models\Detail', 'detail_id', 'id');
    }
}
