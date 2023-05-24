<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use App\Models\Expenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($type_id)
    {
        return view('forms.expenses.create', ['type_id' => $type_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'quantity' => 'required',
    //         'price_per_qty' => 'required',
    //     ]);
    
    //     $input = $request->all();

    //     $input['account_fk'] = 2;
    //     $input['expense_type_fk'] = 1;
    
    //     Expenses::create($input);
     
    //     return redirect()->route('section.expenses', ['type_id' => 1]);
    //         // ->with('success','Expenses stored successfully.');
    // }

    public function store(Request $request, $type_id)
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

            $request->validate([
                'name' => 'required',
                'quantity' => 'required',
                'price_per_qty' => 'required',
            ]);
            
            $input = $request->all();
    
            $input['account_fk'] = Auth::id();
            $input['expense_type_fk'] = $type_id;
            
            $expenses = Expenses::where('name', $input['name'])->exists();
            if ($expenses) {
                return redirect()->back()->withErrors(['message' => 'Data sudah ada!']);
            }
            
            Expenses::create($input);
            if ($type_id == 1) {
                return redirect()->route('section.expenses', ['type_id' => $type_id])->with('success','Bahan baku berhasil diinput');
            } else if ($type_id == 2) {
                return redirect()->route('section.expenses', ['type_id' => $type_id])->with('success','Operasional berhasil diinput');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Form harus diisi secara lengkap.'])->withInput();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // OLD

        // try {
        //     $request->validate([
        //         'name' => 'required',
        //         'quantity' => 'required',
        //         'price_per_qty' => 'required',
        //     ], [
        //         'name.required' => 'Nama harus diisi', 
        //         'quantity.required' => 'Jumlah harus diisi', 
        //         'price_per_qty.required' => 'Harga harus diisi']);
            
        //     $input = $request->all();
    
        //     $input['account_fk'] = 2;
        //     $input['expense_type_fk'] = $type_id;
            
        //     $expenses = Expenses::where('name', $input['name'])->exists();
        //     if ($expenses) {
        //         return redirect()->back()->withErrors(['message' => 'Data sudah ada!']);
        //     }
            
        //     Expenses::create($input);
        //     return redirect()->route('section.expenses', ['type_id' => $type_id]);
        // } catch (\Exception $e) {
        //     return redirect()->back()->withErrors(['error' => 'Form harus diisi secara lengkap.'])->withInput();
        // } catch (ValidationException $e) {
        //     return redirect()->back()->withErrors($e->errors())->withInput();
        // }
            // ->with('success','Expenses stored successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expenses $expenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expenses $expense)
    {
        return view('forms.expenses.edit', ['expense' => $expense]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expenses $expense)
    {
        try {
            
            $input = $request->validate([
                'name' => 'required',
                'quantity' => 'required',
                'price_per_qty' => 'required',
            ]);
              
            $expense->update($input);
    
            return redirect()->route('section.expenses', ['type_id' => $expense->expense_type_fk])
                ->with('success','Data sudah diubah');
        
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Form harus diisi secara lengkap.'])->withInput();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expenses $expense)
    {
        $expense->delete();
        return redirect()->route('section.expenses', ['type_id' => 1])
            ->with('success','Data berhasil dihapus');
    }
}
