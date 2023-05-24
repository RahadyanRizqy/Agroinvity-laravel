<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
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
    public function create()
    {
        return view('forms.incomes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
        //     // $request->validate([
        //     //     'name' => 'required',
        //     //     'quantity' => 'required',
        //     //     'price_per_qty' => 'required',
        //     // ], [
        //     //     'name.required' => 'Nama harus diisi', 
        //     //     'quantity.required' => 'Jumlah harus diisi', 
        //     //     'price_per_qty.required' => 'Harga harus diisi']);

        //     $input = $request->validate([
        //         'name' => 'required',
        //         'total_qty' => 'required',
        //         'sold_products' => 'required',
        //         'stock_products' => 'required',
        //         'price_per_qty' => 'required',
        //     ]);
            $input = $request->validate([
                'name' => 'required',
                'total_qty' => 'required',
                'sold_products' => 'required',
                'price_per_qty' => 'required',
            ]);

            $input['account_fk'] = Auth::id();
            
            $products = Products::where('name', $input['name'])->exists();
            if ($products) {
                return redirect()->back()->withErrors(['message' => 'Data sudah ada!']);
            }
            
            Products::create($input);
            return redirect()->route('section.production')->with('success','Produk berhasil diinput');;
            
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Form harus diisi secara lengkap.'])->withInput();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }
}
