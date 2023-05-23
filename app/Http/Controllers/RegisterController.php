<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('usersession.register');
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
        // $input = $request->validate([
        //     'fullname' => 'required|max:255',
        //     'email' => 'required|email:dns|min:2|max:255|unique:accounts',
        //     'phone_number' => 'required|numeric|digits_between:12,20',
        //     'password' => 'required|min:2|max:255',
        // ]);

        // $input['password'] = Hash::make($input['password']);
        // $input['created_at'] = 
        
        $input = $request->validate([
            'fullname' => 'required|max:255',
            'email' => 'required|email:dns|min:2|max:255|unique:accounts',
            'phone_number' => 'required|numeric|digits_between:12,20',
            'password' => 'required|min:2|max:255',
        ]);

        $input['password'] = Hash::make($input['password']);
        
        // $input = $request->all();

        // $input['account_fk'] = Hash::make();

        $expenses = Accounts::where('email', $input['email'])->exists();
        if ($expenses) {
            return redirect()->back()->withErrors(['error' => 'Data sudah ada!']);
        }
        Accounts::create($input);
        return redirect()->route('login.index');

        // try {
        //     $input = $request->validate([
        //         'fullname' => 'required|max:255',
        //         'email' => 'required|email:dns|min:2|max:255|unique:accounts',
        //         'phone_number' => 'required|numeric|digits_between:12,20',
        //         'password' => 'required|min:2|max:255',
        //     ]);

        //     $input['password'] = Hash::make($input['password']);
            
        //     // $input = $request->all();
    
        //     // $input['account_fk'] = Hash::make();

        //     $expenses = Accounts::where('email', $input['email'])->exists();
        //     if ($expenses) {
        //         return redirect()->back()->withErrors(['error' => 'Data sudah ada!']);
        //     }
        //     Accounts::create($input);
        //     return redirect()->route('login.index');
        //     // return redirect()->route('dashboard', ['type_id' => $type_id]);
        // } catch (\Exception $e) {
        //     return redirect()->back()->withErrors(['error' => 'Form harus diisi secara lengkap.'])->withInput();
        // }
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
        //
    }
}
