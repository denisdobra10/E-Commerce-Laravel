<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->path() == "login" && $request->session()->has('user'))
        {
            return redirect('/');
        }

        if(!$request->session()->has('user'))
        {
            if($request->path() == "createproduct")
            {
                return redirect('/');
            }

            if($request->path() == "showorders")
            {
                return redirect('/');
            }

            if($request->path() == "finishorder")
            {
                return redirect('/');
            }

            if($request->path() == "deleteallorders")
            {
                return redirect('/');
            }

            if($request->path() == "deleteorder")
            {
                return redirect('/');
            }

            if($request->path() == "edit")
            {
                return redirect('/');
            }

            if($request->path() == "edit/edit-product")
            {
                return redirect('/');
            }

            if($request->path() == "delete-product")
            {
                return redirect('/');
            }
        }
        else
        {

            if ($request->path() == "createproduct" && session()->get('user')['username'] != "administrator")
            {
                return redirect('/');
            }

            if($request->path() == "showorders" && session()->get('user')['username'] != "administrator")
            {
                return redirect('/');
            }
    
            if ($request->path() == "finishorder" && session()->get('user')['username'] != "administrator")
            {
                return redirect('/');
            }
    
            if ($request->path() == "deleteallorders" && session()->get('user')['username'] != "administrator")
            {
                return redirect('/');
            }
    
            if ($request->path() == "deleteorder" && session()->get('user')['username'] != "administrator")
            {
                return redirect('/');
            }
    
            if ($request->path() == "edit" && session()->get('user')['username'] != "administrator")
            {
                return redirect('/');
            }
    
            if ($request->path() == "edit/edit-product" && session()->get('user')['username'] != "administrator")
            {
                return redirect('/');
            }
    
            if ($request->path() == "delete-product" && session()->get('user')['username'] != "administrator")
            {
                return redirect('/');
            }
        }


        return $next($request);
    }

}
