<?php

namespace App\Models;

use Eloquent as Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
* Class Post
* @package App\Models
* @version December 9, 2020, 12:46 pm UTC
*
* @property string $header
* @property string $text
* @property string $author
* @property boolean $is_admin
*/
class Post extends Model
{
    // use SoftDeletes;
    
    use HasFactory;
    
    public $table = 'posts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    protected $dates = ['deleted_at'];
    
    public $fillable = [
        'header',
        'text',
        'user_id'
    ];
    
    /**
    * The attributes that should be casted to native types.
    *
    * @var array
    */
    protected $casts = [
        'id' => 'integer',
        'header' => 'string',
        'text' => 'string',
        'user_id' => 'integer',
    ];
    
    /**
    * Validation rules
    *
    * @var array
    */
    public static $rules = [
        'header' => 'required|string|max:128',
        'text' => 'required|string',
        // 'author' => 'required|string|max:64',
        // The categories may not have more than 6 items.
        'categories' => 'required|array|max:6',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];
    
    public function getPostDate()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d F, Y');
    }
    
    public function getPostDateWithoutYear()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d F');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
        // return $this->belongsTo('App\Models\User')->withTimestamps();
    }
    
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category')->withTimestamps();
    }
}
