<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Expenses;
use Illuminate\Http\Request;
use App\Http\Controllers\ArticleController;
use App\Models\Accounts;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;

class DashboardController extends Controller
{
    public function showDashboard() # SHOW
    {
        return view('dashboard', ['section' => 'main', 'accountId' => Auth::id()]);
    }

    public function indexExpense($type_id) {
        // $expenses = Expenses::where('expense_type_fk', $type_id)
        //     ->where('account_fk', Auth::id())->get();
        $expenses = Accounts::with('ownExpense.expenseType')
            ->find(Auth::id())
            ->ownExpense
            ->where('expenseType.id', $type_id);

        if ($type_id == 1) {
            return view('dashboard', ['expenses' => $expenses, 'section' => 'expense', 'type_id' => $type_id])
                ->with('i', (request()->input('page', 1) - 1) * 10);
        } else if ($type_id == 2) {
            return view('dashboard', ['expenses' => $expenses, 'section' => 'expense', 'type_id' => $type_id])
                ->with('i', (request()->input('page', 1) - 1) * 10);
        }
    }

    public function indexArticle() # SHOW
    {
        $articles = Articles::paginate(5);
    
        return view('dashboard',compact('articles'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('section', 'article');
    }

    public function indexProduction() {
        $products = Accounts::with('ownProduct')->find(Auth::id())->ownProduct;
        return view('dashboard', ['productions' => $products, 'section' => 'product'])
            ->with('i', (request()->input('page', 1) - 1) * 15);

    }

    public function indexCalculator()
    {
        return view('dashboard', ['section' => 'calculator']);
    }
    
    public function dashboardLogout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
    
    public function dashboardProfile() {
        return view('forms.accounts.edit')
        ->with('account', Accounts::where('id', Auth::id())->get()->first());
    }

    public function showReportResults(Request $request) {
        $input = $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);

        $id = Auth::id();
        $dateFrom = Carbon::createFromFormat('d M Y', $input['from'])->format('Y-m-d');
        $dateTo = Carbon::createFromFormat('d M Y', $input['to'])->format('Y-m-d');
        // dd($fromDate, $toDate);
        // $inputDate = '01 May 2023';
        // $locale = 'id'; // Indonesian locale
        
        // // Set the locale
        // Carbon::setLocale($locale);
        
        // // Define the custom month translations
        // // Lang::get('date')->setMonths([
        // //     'Januari', 'Februari', 'Maret', 'April',
        // //     'Mei', 'Juni', 'Juli', 'Agustus',
        // //     'September', 'Oktober', 'November', 'Desember'
        // // ]);
        
        // // Convert the date string to the desired format
        // $carbonDate = Carbon::createFromFormat('d F Y', $inputDate);
        // $formattedDate = $carbonDate->format('Y-m-d');
        // dd($formattedDate);
        // $dateFrom = $input['from'];
        // $dateTo = $input['to'];
        $products = DB::select("SELECT SUM(sold_products*price_per_qty) as p FROM products WHERE stored_at BETWEEN '{$dateFrom}' AND '{$dateTo}' AND account_fk = $id;")[0]->p;
        $expenses = DB::select("SELECT SUM(quantity*price_per_qty) as e FROM expenses WHERE stored_at BETWEEN '{$dateFrom}' AND '{$dateTo}' AND account_fk = $id;")[0]->e;

        return view('dashboard', ['section' => 'report', 'incomes' => $products, 'expenses' => $expenses, 'datefrom' => $dateFrom, 'dateto' => $dateTo]);
        // try {
        //     $input = $request->validate([
        //         'from' => 'required',
        //         'to' => 'required',
        //     ]);

        //     $id = Auth::id();
        //     $dateFrom = $input['from'];
        //     $dateTo = $input['to'];
        //     $products = DB::select("SELECT SUM(sold_products*price_per_qty) as p FROM products WHERE stored_at BETWEEN '{$dateFrom}' AND '{$dateTo}' AND account_fk = $id;")[0]->p;
        //     $expenses = DB::select("SELECT SUM(quantity*price_per_qty) as e FROM expenses WHERE stored_at BETWEEN '{$dateFrom}' AND '{$dateTo}' AND account_fk = $id;")[0]->e;

        //     return view('dashboard', ['section' => 'report', 'incomes' => 1, 'expenses' => 1]);
            
        //     // Expenses::create($input);
        //     // if ($type_id == 1) {
        //         //     return redirect()->route('section.expenses', ['type_id' => $type_id])->with('success','Bahan baku berhasil diinput');
        //         // } else if ($type_id == 2) {
        //             //     return redirect()->route('section.expenses', ['type_id' => $type_id])->with('success','Operasional berhasil diinput');
        //             // }
        // } catch (\Exception $e) {
        //     return redirect()->back()->withErrors(['error' => 'Form harus diisi secara lengkap.'])->withInput();
        // } catch (ValidationException $e) {
        //     return redirect()->back()->withErrors($e->errors())->withInput();
        // }

        
        return view('dashboard', ['section' => 'report']);
    }

    public function indexReport()
    {
        $id = Auth::id();
        $currentMonth = Carbon::now()->format('Y-m');
        $products = DB::select("SELECT SUM(sold_products*price_per_qty) as p FROM products WHERE DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}' AND account_fk = $id")[0]->p;
        $expenses = DB::select("SELECT SUM(quantity*price_per_qty) as e FROM expenses WHERE DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}' AND account_fk = $id")[0]->e;
    
        return view('dashboard', ['section' => 'report', 'incomes' => $products, 'expenses' => $expenses]);
    }
}
