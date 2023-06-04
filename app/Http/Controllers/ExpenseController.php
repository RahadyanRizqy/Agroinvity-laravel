<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\ActivityLogs;
use Illuminate\Validation\ValidationException;
use App\Models\Expenses;
use Carbon\Carbon;
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
            
            if (Auth::user()->account_type_fk == 3) {
                $input['account_fk'] = Accounts::with('parentAcc')->find(Auth::id())->parentAcc->id;
            } 
            else {
                $input['account_fk'] = Auth::id();
            }
            $input['expense_type_fk'] = $type_id;
            $input['stored_at'] = Carbon::now()->format('Y-m-d H:i:s');
            
            $expenses = Expenses::where('name', $input['name'])
                                ->where('account_fk', $input['account_fk'])
                                ->exists();
            if ($expenses) {
                return redirect()->back()->withErrors(['message' => 'Data sudah ada!']);
            }
            
            $getId = Expenses::create($input)->id;
            if (Auth::user()->account_type_fk == 3) {
                $this->LoggerInsert($getId, $type_id);
            }
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

            if (Auth::user()->account_type_fk == 3) {
                $this->LoggerUpdate($expense->id, $expense->expense_type_fk);
            }
    
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
        $this->LoggerDelete($expense->id, $expense->expense_type_fk);
        return redirect()->route('section.expenses', ['type_id' => $expense->expense_type_fk])
            ->with('success','Data berhasil dihapus');
    }

    // FOR WORKER ONLY
    public function LoggerInsert($id, $type_id)
    {
        if ($type_id == 1) {
            ActivityLogs::where('logs', "Telah menginputkan data bahan baku baru dengan id: $id")
            ->orderBy('id', 'DESC')->limit(1)
            ->update([
                'by_child' => true,
            ]);
        } else if ($type_id == 2){
            ActivityLogs::where('logs', "Telah menginputkan data operasional baru dengan id: $id")
            ->orderBy('id', 'DESC')->limit(1)
            ->update([
                'by_child' => true,
            ]);
        }
    }
    
    // FOR WORKER ONLY
    public function LoggerUpdate($id, $type_id)
    {
        if ($type_id == 1) {
            ActivityLogs::where('logs', "Telah mengubah data bahan baku dengan id: $id")
            ->orderBy('id', 'DESC')->limit(1)
            ->update([
                'by_child' => true,
            ]);
        } else if ($type_id == 2){
            ActivityLogs::where('logs', "Telah mengubah data operasional dengan id: $id")
            ->orderBy('id', 'DESC')->limit(1)
            ->update([
                'by_child' => true,
            ]);
        }
    }

    // FOR WORKER ONLY
    public function LoggerDelete($id, $type_id)
    {
        if ($type_id == 1) {
            ActivityLogs::where('logs', "Telah menghapus data bahan baku dengan id: $id")
            ->orderBy('id', 'DESC')->limit(1)
            ->update([
                'by_child' => true,
            ]);
        } else if ($type_id == 2){
            ActivityLogs::where('logs', "Telah menghapus data operasional dengan id: $id")
            ->orderBy('id', 'DESC')->limit(1)
            ->update([
                'by_child' => true,
            ]);
        }
    }
}
