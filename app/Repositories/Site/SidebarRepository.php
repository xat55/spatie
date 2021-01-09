<?php

namespace App\Repositories\Site;

use App\Models\Post;
use App\Repositories\Site\ParentRepository;

/**
 * Class CategoryRepository
 * @package App\Repositories
 * @version December 9, 2020, 12:46 pm UTC
*/

class SidebarRepository extends ParentRepository
{
    public function __construct(Post $post)
    {
        $this->model = $post;
    }
}
