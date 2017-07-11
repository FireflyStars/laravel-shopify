<?php namespace OhMyBrew\ShopifyApp\Middleware;

use Closure;
use Illuminate\Http\Request;
use OhMyBrew\ShopifyApp\Facades\ShopifyApp;

class AuthShop
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (ShopifyApp::shop() === null) {
            // Shall not pass, redirect to authentication
            return redirect()->route('authenticate')->withInput(['shop' => request('shop')]);
        }

        // Move on, authenticated
        return $next($request);
    }
}