<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Expenses;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Http\Controllers\ArticleController;
use App\Models\Accounts;
use App\Models\Calculator;
use App\Models\ExpenseHistories;
use App\Models\ProductHistories;
use App\Models\Products;
use Carbon\Carbon;
use DivisionByZeroError;
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
        $action = $request->input('action');
        
        if ($action === 'show') {
            $input = $request->validate([
                'from' => 'required',
                'to' => 'required',
            ]);
            
            $id = Auth::id();
            $dateFrom = Carbon::createFromFormat('d M Y', $input['from'])->format('Y-m-d');
            $dateTo = Carbon::createFromFormat('d M Y', $input['to'])->format('Y-m-d');
            $products = DB::select("SELECT SUM(sold_products*price_per_qty) as p FROM products WHERE stored_at BETWEEN '{$dateFrom}' AND '{$dateTo}' AND account_fk = $id;")[0]->p;
            $expenses = DB::select("SELECT SUM(quantity*price_per_qty) as e FROM expenses WHERE stored_at BETWEEN '{$dateFrom}' AND '{$dateTo}' AND account_fk = $id;")[0]->e;
    
    
            $percentExp1 = Expenses::where('expense_type_fk', 1)
                    ->where('account_fk', Auth::id())
                    ->whereBetween('stored_at', [$dateFrom, $dateTo])
                    ->count();
            $percentExp2 = Expenses::where('expense_type_fk', 2)
                    ->where('account_fk', Auth::id())
                    ->whereBetween('stored_at', [$dateFrom, $dateTo])
                    ->count();
            $productPerc = ProductHistories::where('account_fk', Auth::id())
                    ->whereBetween('updated_at', [$dateFrom, $dateTo])
                    ->count();
    
            $lineResult = ProductHistories::selectRaw('SUM(sold_products * price_per_qty) as CALC, updated_at')
                    ->where('account_fk', 2)
                    ->whereBetween("updated_at", [$dateFrom, $dateTo])
                    ->groupBy('updated_at')
                    ->get();
    
            $lineDates = [];
            $lineValues = [];
    
            foreach ($lineResult as $dv) {
                $lineDates[] = $dv['updated_at'];
                $lineValues[] = $dv['CALC'];
            }
    
            function mapperCentage($num, $total)
            {
                try {
                    return ($num / $total) * 100;
                }
                catch (DivisionByZeroError $e) {
                    return 0;
                }
            }
    
            $percentageArr = array($percentExp1, $percentExp2, $productPerc);
            $c = array_sum($percentageArr);
            $percentageChart = [];
    
            foreach ($percentageArr as $num) {
                $percentage = mapperCentage($num, $c);
                $percentageChart[] = $percentage;
            }
    
            return view('dashboard', 
            [
                'section' => 'report', 
                'incomes' => $products, 
                'expenses' => $expenses, 
                'datefrom' => $dateFrom, 
                'dateto' => $dateTo, 
                'percentageChart' => $percentageChart, 
                'percentageArr' => $percentageArr,
                'dates' => $lineDates, 
                'lineChart' => $lineValues,
                
            ]);
        } else if ($action === 'print') {

            if ($request->filled('from') && $request->filled('to')) {
                $input = $request->validate([
                    'from' => 'required',
                    'to' => 'required',
                ]);
                
                $id = Auth::id();
                $dateFrom = Carbon::createFromFormat('d M Y', $input['from'])->format('Y-m-d');
                $dateTo = Carbon::createFromFormat('d M Y', $input['to'])->format('Y-m-d');
                $products = DB::select("SELECT SUM(sold_products*price_per_qty) as p FROM products WHERE stored_at BETWEEN '{$dateFrom}' AND '{$dateTo}' AND account_fk = $id;")[0]->p;
                $expenses = DB::select("SELECT SUM(quantity*price_per_qty) as e FROM expenses WHERE stored_at BETWEEN '{$dateFrom}' AND '{$dateTo}' AND account_fk = $id;")[0]->e;
        
        
                $percentExp1 = Expenses::where('expense_type_fk', 1)
                        ->where('account_fk', Auth::id())
                        ->whereBetween('stored_at', [$dateFrom, $dateTo])
                        ->count();
                $percentExp2 = Expenses::where('expense_type_fk', 2)
                        ->where('account_fk', Auth::id())
                        ->whereBetween('stored_at', [$dateFrom, $dateTo])
                        ->count();
                $productPerc = ProductHistories::where('account_fk', Auth::id())
                        ->whereBetween('updated_at', [$dateFrom, $dateTo])
                        ->count();
        
                $lineResult = ProductHistories::selectRaw('SUM(sold_products * price_per_qty) as CALC, updated_at')
                        ->where('account_fk', 2)
                        ->whereBetween("updated_at", [$dateFrom, $dateTo])
                        ->groupBy('updated_at')
                        ->get();
        
                $lineDates = [];
                $lineValues = [];
        
                foreach ($lineResult as $dv) {
                    $lineDates[] = $dv['updated_at'];
                    $lineValues[] = $dv['CALC'];
                }
        
                function mapperCentageReport($num, $total)
                {
                    try {
                        return ($num / $total) * 100;
                    }
                    catch (DivisionByZeroError $e) {
                        return 0;
                    }
                }
        
                $percentageArr = array($percentExp1, $percentExp2, $productPerc);
                $c = array_sum($percentageArr);
                $percentageChart = [];
        
                foreach ($percentageArr as $num) {
                    $percentage = mapperCentageReport($num, $c);
                    $percentageChart[] = $percentage;
                }
        
                return view('section/report_print', 
                [
                    'incomes' => $products, 
                    'expenses' => $expenses, 
                    'datefrom' => $dateFrom, 
                    'dateto' => $dateTo, 
                    'percentageChart' => $percentageChart, 
                    'percentageArr' => $percentageArr,
                    'dates' => $lineDates, 
                    'lineChart' => $lineValues,
                    
                ]);
                // $pdf = app('dompdf.wrapper');
                // $pdf->loadView('section/report_print', 
                // [
                //     'incomes' => $products, 
                //     'expenses' => $expenses, 
                //     'datefrom' => $dateFrom, 
                //     'dateto' => $dateTo, 
                //     'percentageChart' => $percentageChart, 
                //     'percentageArr' => $percentageArr,
                //     'dates' => $lineDates, 
                //     'lineChart' => $lineValues,
                    
                // ]);
                // return $pdf->download('laporan-1.pdf');
            }
            else {

                $id = Auth::id();
                $currentMonth = Carbon::now()->format('Y-m');
                $products = DB::select("SELECT SUM(sold_products*price_per_qty) as p FROM products WHERE DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}' AND account_fk = $id")[0]->p;
                $expenses = DB::select("SELECT SUM(quantity*price_per_qty) as e FROM expenses WHERE DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}' AND account_fk = $id")[0]->e;
                
                $percentExp1 = Expenses::where('expense_type_fk', 1)
                                ->where('account_fk', Auth::id())
                                ->whereRaw("DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}'")
                                ->count();
                $percentExp2 = Expenses::where('expense_type_fk', 2)
                                ->where('account_fk', Auth::id())
                                ->whereRaw("DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}'")
                                ->count();
                $productPerc = Products::where('account_fk', Auth::id())
                                ->whereRaw("DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}'")
                                ->count();
    
                $lineResult = ProductHistories::selectRaw('SUM(sold_products * price_per_qty) as CALC, updated_at')
                                ->where('account_fk', 2)
                                ->whereRaw("DATE_FORMAT(updated_at, '%Y-%m') = '{$currentMonth}'")
                                ->groupBy('updated_at')
                                ->get();
    
                $lineDates = [];
                $lineValues = [];
    
                foreach ($lineResult as $dv) {
                    $lineDates[] = $dv['updated_at'];
                    $lineValues[] = $dv['CALC'];
                }
    
                function myfunction($num, $total)
                {
                    try {
                        return ($num / $total) * 100;
                    }
                    catch (DivisionByZeroError $e) {
                        return 0;
                    }
                }
    
                $percentageArr = array($percentExp1, $percentExp2, $productPerc);
                $c = array_sum($percentageArr);
                $percentageChart = [];
    
                foreach ($percentageArr as $num) {
                    $percentage = myfunction($num, $c);
                    $percentageChart[] = $percentage;
                }
                
    
                return view('section/report_print', 
                [
                    'incomes' => $products, 
                    'expenses' => $expenses, 
                    'percentageChart' => $percentageChart, 
                    'percentageArr' => $percentageArr, 
                    'dates' => $lineDates, 
                    'lineChart' => $lineValues
                ]);

                // $pdf = app('dompdf.wrapper');
                // $pdf->loadView('section/report_print', 
                // [
                //     'incomes' => $products, 
                //     'expenses' => $expenses, 
                //     'percentageChart' => $percentageChart, 
                //     'percentageArr' => $percentageArr, 
                //     'dates' => $lineDates, 
                //     'lineChart' => $lineValues
                // ]);
                // return $pdf->download('laporan-1.pdf');
            }
        }

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
        
        $percentExp1 = Expenses::where('expense_type_fk', 1)
                        ->where('account_fk', Auth::id())
                        ->whereRaw("DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}'")
                        ->count();
        $percentExp2 = Expenses::where('expense_type_fk', 2)
                        ->where('account_fk', Auth::id())
                        ->whereRaw("DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}'")
                        ->count();
        $productPerc = Products::where('account_fk', Auth::id())
                        ->whereRaw("DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}'")
                        ->count();

        $lineResult = ProductHistories::selectRaw('SUM(sold_products * price_per_qty) as CALC, updated_at')
                        ->where('account_fk', 2)
                        ->whereRaw("DATE_FORMAT(updated_at, '%Y-%m') = '{$currentMonth}'")
                        ->groupBy('updated_at')
                        ->get();

        $lineDates = [];
        $lineValues = [];

        foreach ($lineResult as $dv) {
            $lineDates[] = $dv['updated_at'];
            $lineValues[] = $dv['CALC'];
        }

        function myfunction($num, $total)
        {
            try {
                return ($num / $total) * 100;
            }
            catch (DivisionByZeroError $e) {
                return 0;
            }
        }

        $percentageArr = array($percentExp1, $percentExp2, $productPerc);
        $c = array_sum($percentageArr);
        $percentageChart = [];

        foreach ($percentageArr as $num) {
            $percentage = myfunction($num, $c);
            $percentageChart[] = $percentage;
        }
        

        return view('dashboard', 
        [
            'section' => 'report', 
            'incomes' => $products, 
            'expenses' => $expenses, 
            'percentageChart' => $percentageChart, 
            'percentageArr' => $percentageArr, 
            'dates' => $lineDates, 
            'lineChart' => $lineValues
        ]);
        
    }
    
    public function printReport(Request $request) {
        if (!isset($request)) {
            $id = Auth::id();
            $currentMonth = Carbon::now()->format('Y-m');
            $products = DB::select("SELECT SUM(sold_products*price_per_qty) as p FROM products WHERE DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}' AND account_fk = $id")[0]->p;
            $expenses = DB::select("SELECT SUM(quantity*price_per_qty) as e FROM expenses WHERE DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}' AND account_fk = $id")[0]->e;
            
            $percentExp1 = Expenses::where('expense_type_fk', 1)
                            ->where('account_fk', Auth::id())
                            ->whereRaw("DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}'")
                            ->count();
            $percentExp2 = Expenses::where('expense_type_fk', 2)
                            ->where('account_fk', Auth::id())
                            ->whereRaw("DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}'")
                            ->count();
            $productPerc = Products::where('account_fk', Auth::id())
                            ->whereRaw("DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}'")
                            ->count();

            $lineResult = ProductHistories::selectRaw('SUM(sold_products * price_per_qty) as CALC, updated_at')
                            ->where('account_fk', 2)
                            ->whereRaw("DATE_FORMAT(updated_at, '%Y-%m') = '{$currentMonth}'")
                            ->groupBy('updated_at')
                            ->get();

            $lineDates = [];
            $lineValues = [];

            foreach ($lineResult as $dv) {
                $lineDates[] = $dv['updated_at'];
                $lineValues[] = $dv['CALC'];
            }

            function myfunction($num, $total)
            {
                try {
                    return ($num / $total) * 100;
                }
                catch (DivisionByZeroError $e) {
                    return 0;
                }
            }

            $percentageArr = array($percentExp1, $percentExp2, $productPerc);
            $c = array_sum($percentageArr);
            $percentageChart = [];

            foreach ($percentageArr as $num) {
                $percentage = myfunction($num, $c);
                $percentageChart[] = $percentage;
            }
            

            
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('section/report_print', 
            [
                'incomes' => $products, 
                'expenses' => $expenses, 
                'percentageChart' => $percentageChart, 
                'percentageArr' => $percentageArr, 
                'dates' => $lineDates, 
                'lineChart' => $lineValues
            ]);
            return $pdf->download('laporan-1.pdf');
            
        }
        $input = $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);
        
        $id = Auth::id();
        $dateFrom = Carbon::createFromFormat('d M Y', $input['from'])->format('Y-m-d');
        $dateTo = Carbon::createFromFormat('d M Y', $input['to'])->format('Y-m-d');
        $products = DB::select("SELECT SUM(sold_products*price_per_qty) as p FROM products WHERE stored_at BETWEEN '{$dateFrom}' AND '{$dateTo}' AND account_fk = $id;")[0]->p;
        $expenses = DB::select("SELECT SUM(quantity*price_per_qty) as e FROM expenses WHERE stored_at BETWEEN '{$dateFrom}' AND '{$dateTo}' AND account_fk = $id;")[0]->e;


        $percentExp1 = Expenses::where('expense_type_fk', 1)
                ->where('account_fk', Auth::id())
                ->whereBetween('stored_at', [$dateFrom, $dateTo])
                ->count();
        $percentExp2 = Expenses::where('expense_type_fk', 2)
                ->where('account_fk', Auth::id())
                ->whereBetween('stored_at', [$dateFrom, $dateTo])
                ->count();
        $productPerc = ProductHistories::where('account_fk', Auth::id())
                ->whereBetween('updated_at', [$dateFrom, $dateTo])
                ->count();

        $lineResult = ProductHistories::selectRaw('SUM(sold_products * price_per_qty) as CALC, updated_at')
                ->where('account_fk', 2)
                ->whereBetween("updated_at", [$dateFrom, $dateTo])
                ->groupBy('updated_at')
                ->get();

        $lineDates = [];
        $lineValues = [];

        foreach ($lineResult as $dv) {
            $lineDates[] = $dv['updated_at'];
            $lineValues[] = $dv['CALC'];
        }

        function mapperCentageReport($num, $total)
        {
            try {
                return ($num / $total) * 100;
            }
            catch (DivisionByZeroError $e) {
                return 0;
            }
        }

        $percentageArr = array($percentExp1, $percentExp2, $productPerc);
        $c = array_sum($percentageArr);
        $percentageChart = [];

        foreach ($percentageArr as $num) {
            $percentage = mapperCentageReport($num, $c);
            $percentageChart[] = $percentage;
        }

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('section/report_print', 
        [
            'incomes' => $products, 
            'expenses' => $expenses, 
            'datefrom' => $dateFrom, 
            'dateto' => $dateTo, 
            'percentageChart' => $percentageChart, 
            'percentageArr' => $percentageArr,
            'dates' => $lineDates, 
            'lineChart' => $lineValues,
            
        ]);
        return $pdf->download('laporan-1.pdf');
    }


    // CALCULATORS
    public function indexCalculator()
    {
        $currentMonth = Carbon::now()->format('Y-m');
        $toId = Auth::user()->id;
        if (Auth::user()->account_type_fk == 3) {
            $toId = Accounts::with('parentAcc')->find(Auth::id())->parentAcc->id;
        }
        $calc = Calculator::where('account_fk', $toId)->whereRaw("DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}'")->get();
        return view('dashboard', ['section' => 'calculator', 'calc' => $calc]);
    }

    public function showCalcResult(Request $request) {
        $action = $request->input('action');
        
        if ($request->filled('from') && $request->filled('to')) {
            $input = $request->validate([
                'from' => 'required',
                'to' => 'required',
            ]);

            $toId = Auth::user()->id;
            if (Auth::user()->account_type_fk == 3) {
                $toId = Accounts::with('parentAcc')->find(Auth::id())->parentAcc->id;
            }
            $dateFrom = Carbon::createFromFormat('d M Y', $input['from'])->format('Y-m-d');
            $dateTo = Carbon::createFromFormat('d M Y', $input['to'])->format('Y-m-d');
            if ($action === 'material') {
                // INSERT!
                $exp1 = Expenses::select(DB::raw('SUM(price_per_qty*quantity) as total'))->where('account_fk', $toId)->where('expense_type_fk', 1)->whereBetween('stored_at', [$dateFrom, $dateTo])->get()->first()->total;
                if ($exp1 == 0 || $exp1 == null) {
                    $exp1 = 0;
                }
                DB::table('calculators')->insert([
                    'histories' => "[Bahan Baku: $exp1]" . "({$input['from']} - {$input['to']})",
                    'account_fk' => $toId,
                    // 'values' => "[Operasional: $calc]"
                ]);
                return redirect()->route('section.calculator');

            } else if ($action === 'operational') {
                // INSERT!
                $exp2 = Expenses::select(DB::raw('SUM(price_per_qty*quantity) as total'))->where('account_fk', $toId)->where('expense_type_fk', 2)->whereBetween('stored_at', [$dateFrom, $dateTo])->get()->first()->total;
                if ($exp2 == 0 || $exp2 == null) {
                    $exp2 = 0;
                }
                DB::table('calculators')->insert([
                    'histories' => "[Operasional: $exp2]" . "({$input['from']} - {$input['to']})",
                    'account_fk' => $toId,
                    // 'values' => "[Operasional: $calc]"
                ]);
                return redirect()->route('section.calculator');

            } else if ($action === 'product') {
                // INSERT!

                $pro = Products::select(DB::raw('SUM(total_qty) as total'))->where('account_fk', $toId)->whereBetween('stored_at', [$dateFrom, $dateTo])->get()->first()->total;
                if ($pro == 0 || $pro == null) {
                    $pro = 0;
                }
                DB::table('calculators')->insert([
                    'histories' => "[Produk: $pro]" . "({$input['from']} - {$input['to']})",
                    'account_fk' => $toId,
                ]);
                return redirect()->route('section.calculator');

            } else if ($action === 'omzet') {
                // INSERT!
                $omzet = Expenses::select(DB::raw('SUM(price_per_qty*quantity) as total'))->where('account_fk', $toId)->whereBetween('stored_at', [$dateFrom, $dateTo])->get()->first()->total;
                if ($omzet == 0 || $omzet == null) {
                    $omzet = 0;
                }
                DB::table('calculators')->insert([
                    'histories' => "[Omzet: $omzet]" . "({$input['from']} - {$input['to']})",
                    'account_fk' => $toId,
                ]);
                return redirect()->route('section.calculator');

            } else if ($action === 'loss') {
                // INSERT!

                $loss = Products::select(DB::raw('SUM(stock_products*price_per_qty) as total'))->where('account_fk', $toId)->whereBetween('stored_at', [$dateFrom, $dateTo])->get()->first()->total;
                if ($loss == 0 || $loss == null) {
                    $loss = 0;
                }
                DB::table('calculators')->insert([
                    'histories' => "[Kerugian: $loss]" . "({$input['from']} - {$input['to']})",
                    'account_fk' => $toId,
                ]);
                return redirect()->route('section.calculator');

            } else if ($action === 'profit') {
                // INSERT!
                $pros = Products::select(DB::raw('SUM(sold_products*price_per_qty) as total'))->where('account_fk', $toId)->whereBetween('stored_at', [$dateFrom, $dateTo])->get()->first()->total;
                if ($pros == 0 || $pros == null) {
                    $pros = 0;
                }
                DB::table('calculators')->insert([
                    'histories' => "[Keuntungan: $pros]" . "({$input['from']} - {$input['to']})",
                    'account_fk' => $toId,
                ]);
                return redirect()->route('section.calculator');

            } else if ($action === 'delete') {

                Calculator::where('account_fk', $toId)->delete();
                return redirect()->route('section.calculator');
            }

        } else {
            $currentMonth = Carbon::now()->format('Y-m');
            $toId = Auth::user()->id;
            if (Auth::user()->account_type_fk == 3) {
                $toId = Accounts::with('parentAcc')->find(Auth::id())->parentAcc->id;
            }
            if ($action === 'material') {
                // INSERT!

                $exp1 = Expenses::select(DB::raw('SUM(price_per_qty*quantity) as total'))->where('account_fk', $toId)->where('expense_type_fk', 1)->whereRaw("DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}'")->get()->first()->total;
                if ($exp1 == 0 || $exp1 == null) {
                    $exp1 = 0;
                }
                DB::table('calculators')->insert([
                    'histories' => "[Bahan Baku: $exp1] Bulan ini",
                    'account_fk' => $toId,
                ]);
                return redirect()->route('section.calculator');

            } else if ($action === 'operational') {
                // INSERT!
                
                $exp2 = Expenses::select(DB::raw('SUM(price_per_qty*quantity) as total'))->where('account_fk', 2)->where('expense_type_fk', 2)->whereRaw("DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}'")->get()->first()->total;
                if ($exp2 == 0 || $exp2 == null) {
                    $exp2 = 0;
                }
                DB::table('calculators')->insert([
                    'histories' => "[Operasional: $exp2] Bulan ini",
                    'account_fk' => $toId,
                ]);
                return redirect()->route('section.calculator');


            } else if ($action === 'product') {
                // INSERT!
                $pro = Products::select(DB::raw('SUM(total_qty) as total'))->where('account_fk', $toId)->whereRaw("DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}'")->get()->first()->total;
                if ($pro == 0 || $pro == null) {
                    $pro = 0;
                }
                DB::table('calculators')->insert([
                    'histories' => "[Produk: $pro] Bulan ini",
                    'account_fk' => $toId,
                ]);
                return redirect()->route('section.calculator');

            } else if ($action === 'omzet') {
                // INSERT!
                $omzet = Expenses::select(DB::raw('SUM(price_per_qty*quantity) as total'))->where('account_fk', $toId)->whereRaw("DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}'")->get()->first()->total;
                if ($omzet == 0 || $omzet == null) {
                    $omzet = 0;
                }
                DB::table('calculators')->insert([
                    'histories' => "[Omzet: $omzet] Bulan ini",
                    'account_fk' => $toId,
                ]);
                return redirect()->route('section.calculator');

            } else if ($action === 'loss') {
                // INSERT!
                $loss = Products::select(DB::raw('SUM(stock_products*price_per_qty) as total'))->where('account_fk', $toId)->whereRaw("DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}'")->get()->first()->total;
                if ($loss == 0 || $loss == null) {
                    $loss = 0;
                }
                DB::table('calculators')->insert([
                    'histories' => "[Kerugian: $loss] Bulan ini",
                    'account_fk' => $toId,
                ]);
                return redirect()->route('section.calculator');

            } else if ($action === 'profit') {
                // INSERT!
                $pros = Products::select(DB::raw('SUM(sold_products*price_per_qty) as total'))->where('account_fk', $toId)->whereRaw("DATE_FORMAT(stored_at, '%Y-%m') = '{$currentMonth}'")->get()->first()->total;
                if ($pros == 0 || $pros == null) {
                    $pros = 0;
                }
                DB::table('calculators')->insert([
                    'histories' => "[Keuntungan: $pros] Bulan ini",
                    'account_fk' => $toId,
                ]);
                return redirect()->route('section.calculator');

            } else if ($action === 'delete') {
                // DELETE!

                Calculator::where('account_fk', $toId)->delete();
                return redirect()->route('section.calculator');
            }
        }
    }

    public function indexExpenseHistory(Expenses $expense) {
        $history = ExpenseHistories::where('expense_fk', $expense->id)->get();
        return view('dashboard', ['section' => 'history', 'table_type' => 1, 'expense_histories' => $history, 'section_back' => $expense->expense_type_fk, 'i' => 0]);
    }

    public function indexProductHistory(Products $product) {
        $history = ProductHistories::where('product_fk', $product->id)->get();
        return view('dashboard', ['section' => 'history', 'table_type' => 2, 'product_histories' => $history, 'i' => 0]);
    }
}

