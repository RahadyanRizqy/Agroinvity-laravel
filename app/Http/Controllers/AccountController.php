<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard')
            ->with('accounts', Accounts::where('account_type_fk', 2)->get())
            ->with('i', 0)
            ->with('section', 'account');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forms.account');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // $request->validate([
            //     'name' => 'required',
            //     'quantity' => 'required',
            //     'price_per_qty' => 'required',
            // ], [
            //     'name.required' => 'Nama harus diisi', 
            //     'quantity.required' => 'Jumlah harus diisi', 
            //     'price_per_qty.required' => 'Harga harus diisi']);

            $input = $request->validate([
                'fullname' => 'required|max:255',
                'email' => 'required|email:dns|min:2|max:255|unique:accounts',
                'phone_number' => 'required|numeric|digits_between:10,20',
                'password' => 'required|min:2|max:255',
            ]);
    
            $input['password'] = Hash::make($input['password']);
        
            $accounts = Accounts::where('email', $input['email'])->exists();
            if ($accounts) {
                return redirect()->back()->withErrors(['error' => 'Data sudah ada!']);
            }            
            Accounts::create($input);
            return redirect()->route('accounts.index')
                ->with('success','Akun mitra berhasil dibuat');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Form harus diisi secara lengkap.'])->withInput();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
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
    public function update(Request $request, Accounts $account)
    {
        try {
            
            $input = $request->validate([
                'fullname' => 'required|max:255',
                'email' => 'required|email:dns|min:2|max:255|',
                'phone_number' => 'required|numeric|digits_between:10,20',
                'password' => 'required|min:2|max:255',
            ]);
      
            $input = $request->all();
    
            $input['password'] = Hash::make($input['password']);
              
            $account->update($input);
    
            return redirect()->route('section.main')
                ->with('success','Akun sudah diubah');
        
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Form harus diisi secara lengkap.'])->withInput();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accounts $accounts)
    {
        //
    }
}
