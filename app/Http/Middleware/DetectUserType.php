<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DetectUserType
{
    public function handle(Request $request, Closure $next)
    {
        $userType = auth()->check() ? auth()->user()->user_type : null;
        if ($userType === 'admin') {
            $layout = 'layouts.admin';
        } elseif ($userType === 'customer') {
            $layout = 'layouts.customer';
        } elseif ($userType === 'vendor') {
            $layout = 'layouts.vendor';
        } else {
            $layout = 'layouts.default';
        }

        view()->share('layout', $layout);
    
        return $next($request);
    }
    

}
