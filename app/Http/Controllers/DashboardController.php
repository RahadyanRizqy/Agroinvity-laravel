<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Expenses;
use Illuminate\Http\Request;
use App\Http\Controllers\ArticleController;
use App\Models\Products;

class DashboardController extends Controller
{
    public function showDashboard() # SHOW
    {
        return view('dashboard', ['section' => 'main']);
    }

    public function indexExpense($type_id) {
        $expenses = Expenses::where('expense_type_fk', $type_id)->paginate(10);

        if ($type_id == 1) {
            return view('dashboard', ['expenses' => $expenses, 'section' => 'expense'])
                ->with('i', (request()->input('page', 1) - 1) * 10);
        } else if ($type_id == 2) {
            return view('dashboard', ['expenses' => $expenses, 'section' => 'expense'])
                ->with('i', (request()->input('page', 1) - 1) * 10);
        }
    }

    // public function indexMaterial()
    // {
    //     $expenses = Expenses::where('expense_type_fk', 1)->paginate(10);

    //     return view('dashboard', ['expenses' => $expenses, 'section' => 'material'])
    //         ->with('i', (request()->input('page', 1) - 1) * 10);
    // }

    // public function indexOperational()
    // {
    //     $expenses = Expenses::where('expense_type_fk', 2)->paginate(10);

    //     return view('dashboard', ['expenses' => $expenses, 'section' => 'material'])
    //         ->with('i', (request()->input('page', 1) - 1) * 10);
    // }

    public function indexArticle() # SHOW
    {
        $articles = Articles::paginate(5);
        return view('dashboard', ['articles' => $articles, 'section' => 'article'])
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function indexProduction() {
        $products = Products::all();
        return view('dashboard', ['productions' => $products, 'section' => 'production'])
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
}