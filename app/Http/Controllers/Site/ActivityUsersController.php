<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Flash;

/**
 * Class ActivityUsersController
 * @package App\Http\Controllers\Site
 */
class ActivityUsersController extends SiteController
{
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function blockUser($id)
    {
        $user = User::findOrfail($id);

        if ($user->hasRole('admin')) {
            Flash::error('Admin cannot be banned.');

            return $this->redirectBack();
        }

        if ($user->hasRole('user')) {

            $user->removeRole('user');
            $user->assignRole('banned');

            Flash::success('User is banned.');

            return $this->redirectBack();
        }

        if ($user->hasRole('banned')) {

            $user->removeRole('banned');
            $user->assignRole('user');

            Flash::success('User is unbanned.');

            return $this->redirectBack();
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    private function redirectBack()
    {
        return redirect()->back();
    }
}
