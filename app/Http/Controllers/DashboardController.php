<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Expenses;
use Illuminate\Http\Request;
use App\Http\Controllers\ArticleController;
use App\Models\Accounts;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

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
            return view('dashboard', ['expenses' => $expenses, 'section' => 'expense', 'type' => $type_id])
                ->with('i', (request()->input('page', 1) - 1) * 10);
        } else if ($type_id == 2) {
            return view('dashboard', ['expenses' => $expenses, 'section' => 'expense', 'type' => $type_id])
                ->with('i', (request()->input('page', 1) - 1) * 10);
        }
    }

    public function indexArticle() # SHOW
    {
        $articles = Articles::paginate(5);
        return view('dashboard', ['articles' => $articles, 'section' => 'article'])
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function indexProduction() {
        $products = Accounts::with('ownProduct')->find(Auth::id())->ownProduct;
        return view('dashboard', ['productions' => $products, 'section' => 'product'])
            ->with('i', (request()->input('page', 1) - 1) * 15);

    }

    public function indexReport()
    {
        return view('dashboard', ['section' => 'report']);
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
}
