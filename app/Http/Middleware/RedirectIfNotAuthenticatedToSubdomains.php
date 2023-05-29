<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticatedToSubdomains
{
    // public function handle(Request $request, Closure $next)
    // {
    //     $subdomains = ['dashboard', 'products']; // Add more subdomains if needed

    //     if (!auth()->check() && $this->isSubdomainRoute($request, $subdomains)) {
    //         return redirect('forbidden'); // Replace '/' with the homepage URL
    //     }

    //     return $next($request);
    // }

    // protected function isSubdomainRoute(Request $request, array $subdomains)
    // {
    //     $host = $request->getHost();
    //     $parts = explode('.', $host);
    //     $subdomain = $parts[0];

    //     return in_array($subdomain, $subdomains);
    // }
}
