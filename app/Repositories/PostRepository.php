<?php

namespace App\Repositories;

use App\Models\Post;
// use Spatie\Permission\Models\Post;
use App\Repositories\BaseRepository;
use Flash;
/**
 * Class PostRepository
 * @package App\Repositories
 * @version December 9, 2020, 12:46 pm UTC
*/

class PostRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'header',
        'text',
        'user_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Post::class;
    }
}
