<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('usersession.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns|min:2|max:255',
            'password' => 'required|min:2|max:255',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // dd($request);
            // dd(Accounts::where('id', Auth::id())->get());
            // return redirect()->intended('dashboard')
            // ->with([
            //     'accountId' => Auth::id(),
            //   ]);

            return redirect()->intended('dashboard');
        }
 
        return back()->with('loginError', 'Akun tidak ada/salah password.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Accounts $accounts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Accounts $accounts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Accounts $accounts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accounts $accounts)
    {
        
    }
}
