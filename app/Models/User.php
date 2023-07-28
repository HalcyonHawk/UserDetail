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
        'prefixname',
        'firstname',
        'middlename',
        'lastname',
        'suffixname',
        'photo',
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

    /**
     * Needed to access attributes with vue
     */
    protected $appends = ['fullName', 'middleInitial', 'profilePhoto', 'gender'];


    public function getFullNameAttribute()
    {
        return $this->firstname . " " . $this->MiddleInitial . ". " . $this->lastname;
    }

    public function getMiddleInitialAttribute()
    {
        return substr($this->middlename, 0, 1);
    }

    public function getGenderAttribute()
    {
        return $this->prefixname === "Mr" ? "Male" : "Female";
    }

    public function getProfilePhotoAttribute()
    {
        return $this->photo
            ? '/storage/' . $this->photo
            : '/images/default.svg';
    }

    /**
     * A user has many details
     */
    public function detail()
    {
        return $this->hasMany('App\Models\Detail', 'detail_id', 'id');
    }
}
