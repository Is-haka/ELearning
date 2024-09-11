<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Categories;

class AddCategories
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Share categories with all views
        view()->share('cat', Categories::all());

        return $next($request);
    }
}
