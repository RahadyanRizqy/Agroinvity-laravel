<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Http\Request;

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
        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'price_per_qty' => 'required',
        ]);
        
        $input = $request->all();

        $input['account_fk'] = 2;
        $input['expense_type_fk'] = $type_id;
        
        try {
            Expenses::create($input);
    
            return redirect()->route('section.expenses', ['type_id' => $type_id]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred. Please try again.']);
        }
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
    public function edit(Expenses $expenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expenses $expenses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expenses $expenses)
    {
        $expenses->delete();
     
        return redirect()->route('section.expenses', ['type_id' => 1])
            ->with('success','article deleted successfully');
    }
}
