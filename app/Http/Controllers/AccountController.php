<?php

namespace App\Http\Controllers;

use App\Mail\MailNotify;
use App\Models\Accounts;
use App\Models\Tokens;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Faker\Factory as Faker;

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
            $request->validate([
                'fullname' => 'required|max:255',
                'email' => 'required|email:dns|min:2|max:255',
                'phone_number' => 'required|numeric|digits_between:10,20',
                'password' => 'required|min:8|max:255',
            ]);

            $input = $request->all();
            
            $accounts = Accounts::where('email', $input['email'])->exists();
            if ($accounts) {
                return redirect()->back()->withErrors(['message' => 'Data sudah ada!']);
            }            

            if (Auth::user()->account_type_fk == 2) {
                $input['account_type_fk'] = 3;
                $input['account_rel_fk'] = Auth::id();
            }
            else if (Auth::user()->account_type_fk == 1) {
                return redirect()->route('accounts.index')
                    ->with('success','Akun mitra berhasil dibuat');
            }
            $input['password'] = Hash::make($input['password']);
            $input['registered_at'] = Carbon::now()->format('Y-m-d H:i:s');
            

            Accounts::create($input);

            return redirect()->route('accounts.index')
                ->with('success','Akun pegawai berhasil dibuat');

        } 
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Form harus diisi secara lengkap.'])->withInput();
        } 
        catch (ValidationException $e) {
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
                'password' => 'required|min:8|max:255',
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

    public function indexPasswordReset(Accounts $account)
    {
        $faker = Faker::create();
        $token = $faker->regexify('[A-Za-z0-9]{30}');
        // return view('forms.password_reset', ['account' => $account]);
    }

    public function indexToken()
    {
        return view('forms.request_token');
    }

    public function sendTokenRequest(Request $request)
    {
        
        try {
            $input = $request->validate([
                'email' => 'required|email:dns|min:2|max:255|'
            ], [
                'email.required' => 'Input email harus diisi'
            ]);
            $emailExists = Accounts::where('email', $input['email'])->exists();
            if ($emailExists) {
                
                if (Accounts::where('email', $input['email'])->first()->account_type_fk == 1) {
                    return redirect()->back()->withErrors(['error' => 'Bila admin salah/lupa password silahkan reset di database'])->withInput();
                } else if (Accounts::where('email', $input['email'])->first()->account_type_fk == 3) {
                    return redirect()->back()->withErrors(['error' => 'Bila pegawai salah/lupa password silahkan hubungi mitra terkait.'])->withInput();
                }
                $tokenGen = Faker::create()->regexify('[A-Za-z0-9]{30}');

                // if ($request->getHost())
                Tokens::create([
                    'token' => $tokenGen, 
                    'account_fk' => Accounts::where('email', $input['email'])->first()->id, 
                    'requested_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
                $data = [
                    'subject' => 'Agroinvity',
                    'body' => "Ini link reset anda 127.0.0.1:8000/reset_password/{$tokenGen} . Link token ini akan berakhir dalam 5 menit",
                ];
        
                Mail::to($input['email'])
                    ->send(new MailNotify($data));
                return view('forms.sent');
            }

            return redirect()->back()->withErrors(['error' => 'Email tidak ditemukan.'])->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Input email harus diisi!'])->withInput();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function checkToken($token)
    {
        $tokenExists = Tokens::where('token', $token)->exists();
        if ($tokenExists) {
            if (Carbon::parse(Carbon::now()->format('Y-m-d H:i:s'))
                ->between
                    (
                        Tokens::where('token', $token)->first()->requested_at, 
                        Tokens::where('token', $token)->first()->expired_at
                    )
                ) 
            {
                $tokenAcc = Tokens::with('tokenOf')->where('token', $token)->first()->tokenOf;
                return view('forms.password_reset', ['account' => $tokenAcc, 'expiredstatus' => 0]);
            }
            else
            {
                return view('forms.password_reset', ['account' => false, 'expiredstatus' => 1]);
            }
        }
        return view('forms.password_reset', ['account' => false, 'expiredstatus' => 2]);
    }

    public function doResetPassword(Request $request, $id) 
    {
        try {
            $token = Tokens::orderBy('id', 'DESC')->first()->token;
            if (Carbon::parse(Carbon::now()->format('Y-m-d H:i:s'))
                ->between
                    (
                        Tokens::where('token', $token)->first()->requested_at, 
                        Tokens::where('token', $token)->first()->expired_at
                    )
                ) 
            {
                $input = $request->validate([
                    'password' => 'required|min:8|max:255',
                    'confirm_password' => 'required|min:8|max:255',
                ]);
        
                if ($input['password'] != $input['confirm_password']) {
                    return redirect()->back()->withErrors(['error' => 'Isian password tidak sesuai.'])->withInput();
                } else {
                    $input['password'] = Hash::make($input['password']);
                      
                    Accounts::where('id', $id)->update(['password' => "{$input['password']}"]);
                    Tokens::where('account_fk', $id)->update(['status' => false]);
                    return redirect()->route('login.index')->with('success','Password berhasil diubah');
                }
            }
            else
            {
                return view('forms.password_reset', ['account' => false, 'expiredstatus' => 1]);
            }
    
        
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Form harus diisi secara lengkap.'])->withInput();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
}
