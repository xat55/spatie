<?php

namespace App\Models;

// use Eloquent as Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
/**
* Class User
* @package App\Models
* @version December 26, 2020, 4:31 pm UTC
*
* @property \Illuminate\Database\Eloquent\Collection $postUsers
* @property string $name
* @property string $email
* @property string|\Carbon\Carbon $email_verified_at
* @property string $password
* @property string $two_factor_secret
* @property string $two_factor_recovery_codes
* @property string $remember_token
* @property integer $current_team_id
* @property string $profile_photo_path
*/
class User extends Authenticatable implements MustVerifyEmail
{
    // use SoftDeletes;

    use HasFactory, HasRoles, Notifiable;

    public $table = 'users';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'email',
        'activity',
        'email_verified_at',
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
        'current_team_id',
        'profile_photo_path'
    ];

    /**
    * The attributes that should be casted to native types.
    *
    * @var array
    */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'two_factor_secret' => 'string',
        'two_factor_recovery_codes' => 'string',
        'remember_token' => 'string',
        'current_team_id' => 'integer',
        'profile_photo_path' => 'string'
    ];

    /**
    * Validation rules
    *
    * @var array
    */
    public static $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'email_verified_at' => 'nullable',
        'password' => 'required|string|max:255',
        'two_factor_secret' => 'nullable|string',
        'two_factor_recovery_codes' => 'nullable|string',
        'remember_token' => 'nullable|string|max:100',
        'current_team_id' => 'nullable',
        'profile_photo_path' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    **/
    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class, 'role_id', 'model_id', 'model_has_roles');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class);
    }
}
