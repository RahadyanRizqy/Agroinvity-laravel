<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Carbon\Carbon;
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
        if (Auth::user()->account_type_fk == 1) {
            return view('dashboard')
                ->with('accounts', Accounts::where('account_type_fk', 2)->get())
                ->with('i', 0)
                ->with('section', 'account');
        } else if (Auth::user()->account_type_fk == 2) {
            return view('dashboard')
                ->with('accounts', Accounts::where('account_type_fk', 3)
                ->where('account_rel_fk', Auth::id())
                ->get())
                ->with('i', 0)
                ->with('section', 'account');
        }
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
            $input = $request->validate([
                'fullname' => 'required|max:255',
                'email' => 'required|email:dns|min:2|max:255|unique:accounts',
                'phone_number' => 'required|numeric|digits_between:10,20',
                'password' => 'required|min:2|max:255',
            ]);
            
            if (Auth::user()->account_type_fk == 2) {
                $input['account_type_fk'] = 3;
                $input['account_rel_fk'] = Auth::id();
            }
            $input['password'] = Hash::make($input['password']);
            $input['registered_at'] = Carbon::now()->format('Y-m-d H:i:s');
        
            $accounts = Accounts::where('email', $input['email'])->exists();
            if ($accounts) {
                return redirect()->back()->withErrors(['error' => 'Data sudah ada!']);
            }            
            Accounts::create($input);

            if (Auth::user()->account_type_fk == 1) {
                return redirect()->route('accounts.index')
                    ->with('success','Akun mitra berhasil dibuat');
            }
            return redirect()->route('accounts.index')
                ->with('success','Akun pegawai berhasil dibuat');

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
    public function edit(Accounts $account)
    {
        return view('forms.accounts.edit', ['account' => $account]);
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
            
            if ($account->account_type_fk == 3) {
                return redirect()->route('section.account')
                    ->with('success','Akun sudah diubah');
            }
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
    public function destroy(Accounts $account)
    {
        $account->delete();
        return redirect()->route('section.account')
            ->with('success','Data berhasil dihapus');
    }
}
