<?php

namespace App\Repositories\Site;

use App\Models\Category;
use App\Repositories\Site\ParentRepository;

/**
 * Class CategoryRepository
 * @package App\Repositories
 * @version December 9, 2020, 12:46 pm UTC
*/

class CategoryRepository extends ParentRepository
{
    public function __construct(Category $category)
    {
        $this->model = $category;
    }
}
