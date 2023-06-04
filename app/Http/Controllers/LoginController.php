<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Carbon\Carbon;
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
            'password' => 'required|min:8|max:255',
        ]);
        
        try {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                
                // dd($request);
                // dd(Accounts::where('id', Auth::id())->get());
                // return redirect()->intended('dashboard')
                // ->with([
                //     'accountId' => Auth::id(),
                //   ]);
            
                if (Auth::user()->account_type_fk == 1) {
                    return redirect()->intended('dashboard');
                } else if (Auth::user()->account_type_fk == 2) {
                    if (Carbon::now()->diffInDays(Auth::user()->registered_at) > 30) {
                        return back()->with('loginError', 'Akun nonaktif silahkan kontak admin untuk aktivasi.');
                    }
                    return redirect()->intended('dashboard');      
                    
                } else {
                    if (Carbon::now()->diffInDays(Accounts::with('parentAcc')->find(Auth::id())->parentAcc->registered_at) > 30) {
                        return back()->with('loginError', 'Akun mitra nonaktif, pegawai tidak bisa masuk.');
                    }
                    // if (Accounts::with('parentAcc')->find(Auth::id())->parentAcc->remaining_days < 0) {
                    //     return back()->with('loginError', 'Akun mitra nonaktif, pegawai tidak bisa masuk.');
                    // }
                    return redirect()->intended('dashboard');       
                }
            }
    
            else {
                if (Accounts::where('email', $credentials['email'])->first()->account_type_fk == 1) {
                    return back()->with('adminError', 'Bila admin salah/lupa password silahkan reset di database');
                } else if (Accounts::where('email', $credentials['email'])->first()->account_type_fk == 3) {
                    return back()->with('workerError', 'Bila pegawai salah/lupa password silahkan hubungi mitra terkait');
                }
            }
            return back()->with('loginError', 'Akun tidak ada/salah password.');
        } 
        catch (\Exception $e) {
            return back()->with('loginError', 'Akun tidak ada/salah password.');
        }
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
