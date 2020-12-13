<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddingRoleToUser
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        $user = auth()->user();
        
        // echo "Аутентификация - ";
        // dump(auth()->check());
        
        // if (isset($user)) {
        //     // code...
        //     dump($user->name);
        // }
        
        if (isset($user)) {
            
            if ($user->hasRole('admin')) {
                dump('Текущий пользователь - '.$user->name);
            } elseif ($user->hasRole('user')) {
                dump('Текущий пользователь - '.$user->name);
            } else {
                dump('Текущий пользователь - '.$user->name.' не admin и не user');
            }
        } else {
            dump('Пользователь НЕ установлен');
        }
        
        // return $next($request);
        return $response;
    }
}
