<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Login;


class AdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sessionToken = Session::get('loginToken');
        $loginUser = Login::where("token", "=", $sessionToken)->first();
        if($loginUser) {
            return $next($request);
        }
        else{            
            return redirect('login')
                        ->with('MustLogin','You must Login to get this services');
        }

    }
}
