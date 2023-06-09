<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
        try {
            $input = $request->validate([
                'fullname' => 'required|max:255',
                'email' => 'required|email:dns|min:2|max:255',
                'phone_number' => 'required|numeric|digits_between:8,20',
                'password' => 'required|min:8|max:255',
            ]);
    
            $input['password'] = Hash::make($input['password']);
            $input['registered_at'] = Carbon::now()->format('Y-m-d H:i:s');
        
            $accounts = Accounts::where('email', $input['email'])->exists();
            if ($accounts) {
                return redirect()->back()->withErrors(['error' => 'Akun sudah ada, silahkan login!']);
            }
            Accounts::create($input);
            return redirect()->route('login.index');
            // return redirect()->route('dashboard', ['type_id' => $type_id]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Form harus diisi dengan benar'])->withInput();
        } catch (ValidationException $e) {
            return redirect()->back()->with('passwordError', 'Panjang password harus 8 hingga 255!');
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
        //
    }
}
