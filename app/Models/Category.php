<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
* Class Category
* @package App\Models
* @version December 9, 2020, 12:46 pm UTC
*
* @property string $name
*/
class Category extends Model
{
    // use SoftDeletes;
    
    use HasFactory;
    
    public $table = 'categories';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    
    protected $dates = ['deleted_at'];
    
    
    
    public $fillable = [
        'name'
    ];
    
    /**
    * The attributes that should be casted to native types.
    *
    * @var array
    */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];
    
    /**
    * Validation rules
    *
    * @var array
    */
    public static $rules = [
        'name' => 'required|string|max:32',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];
    
    public function posts()
    {
        return $this->belongsToMany('App\Models\Post')->withTimestamps();
    }
}
