<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\ActivityLogs;
use App\Models\Products;
use Carbon\Carbon;
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

            if (Auth::user()->account_type_fk == 3) {
                $input['account_fk'] = Accounts::with('parentAcc')->find(Auth::id())->parentAcc->id;
            }
            else {
                $input['account_fk'] = Auth::id();
            }
            $input['stored_at'] = Carbon::now()->format('Y-m-d H:i:s');
            
            $products = Products::where('name', $input['name'])
                                ->where('account_fk', $input['account_fk'])
                                ->exists();
            if ($products) {
                return redirect()->back()->withErrors(['message' => 'Data sudah ada!']);
            }
            
            $getId = Products::create($input)->id;
            if (Auth::user()->account_type_fk == 3) {
                $this->LoggerInsert($getId);
            }
            return redirect()->route('section.production')->with('success','Produk berhasil diinput');
            
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
    public function edit(Products $product)
    {
        return view('forms.incomes.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        try {
            
            $input = $request->validate([
                'name' => 'required',
                'total_qty' => 'required',
                'sold_products' => 'required',
                'price_per_qty' => 'required',
            ]);
              
            $product->update($input);

            if (Auth::user()->account_type_fk == 3) {
                $this->LoggerUpdate($product->id);
            }

            return redirect()->route('section.production')
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
    public function destroy(Products $product)
    {
        $product->delete();
        $this->LoggerDelete($product->id);
        return redirect()->route('section.production')
            ->with('success','Data berhasil dihapus');
    }

    // FOR WORKER ONLY
    public function LoggerInsert($id)
    {
        ActivityLogs::where('logs', "Telah menginputkan data produk baru dengan id: $id")
        ->orderBy('id', 'DESC')->limit(1)
        ->update([
            'by_child' => true,
        ]);
    }
    
    // FOR WORKER ONLY
    public function LoggerUpdate($id)
    {
        ActivityLogs::where('logs', "Telah mengubah data produk dengan id: $id")
        ->orderBy('id', 'DESC')->limit(1)
        ->update([
            'by_child' => true,
        ]);
    }

        // FOR WORKER ONLY
    public function LoggerDelete($id)
    {
        ActivityLogs::where('logs', "Telah menghapus data produk dengan id: $id")
        ->orderBy('id', 'DESC')->limit(1)
        ->update([
            'by_child' => true,
        ]);
    }
}
