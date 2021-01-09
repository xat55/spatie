<?php

namespace App\Repositories\Site;

use App\Models\User;
use App\Repositories\Site\ParentRepository;

/**
 * Class PostRepository
 * @package App\Repositories
 * @version December 9, 2020, 12:46 pm UTC
*/

class UserRepository extends ParentRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
