<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountTypeCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $accountType = $request->Accounts::with('accountType')->find(1)->accountType->account_type_name;
        $userRole = $request->user()->role; // Assuming 'role' is the column name in the 'users' table
        
        // Define the sidebar data based on the user's role
        $sidebarData = [];
        if ($userRole === 'admin') {
            $sidebarData = ['articles', 'partner_accounts'];
        } elseif ($userRole === 'partner') {
            $sidebarData = ['inventory'];
        }
        
        // Share the sidebar data with all views
        \Illuminate\View\View::share('sidebarData', $sidebarData);
        
        return $next($request);
    }
}
