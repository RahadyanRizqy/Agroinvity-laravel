<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() # SHOW
    {
        $articles = Articles::all();
        return view('dashboard', ['articles' => $articles, 'section' => 'article_admin', 'i' => 0]);
            // ->with('i', 1);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() # GO TO CREATE VIEW
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) # STORING PROCESS
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $input = $request->all();
        $input['posted_at'] = Carbon::now()->format('Y-m-d H:i:s');
  
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = "IMG" . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
    
        Articles::create($input);
     
        return redirect()->route('articles.index')
            ->with('success','Articles posted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Articles $article) # GO TO VIEW SHOW
    {

        return view('dashboard', ['article' => $article, 'section' => 'article_show']);
    }

    // public function show(Request $request)
    // {
    //     $article = Articles::find($input[0]);

    //     return view('articles.show', [
    //         'article' => $,
    //         'currentPage' => $input[1],
    //     ]);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articles $article)
    {
        return view('articles.edit',['article' => $article]); # GO TO VIEW UPDATE
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Articles $article) # UPDATING PROCESS
    {
        // $input = $request->validate([
        //     'title' => 'required',
        //     'text' => 'required'
        // ]);
  
        // $input = $request->all();
  

          
        // $articles->update($input);
    
        // return redirect()->route('section.article')
        //     ->with('success','Articles updated successfully');

        try {
        
            $input = $request->validate([
                'title' => 'required',
                'text' => 'required',
            ]);

            if ($image = $request->file('image')) {
                $destinationPath = 'image/';
                $profileImage = "IMG" . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input['image'] = "$profileImage";
            } else {
                unset($input['image']);
            }
            
            $article->update($input);

            return redirect()->route('articles.index')
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
    public function destroy(Articles $article)
    {
        $article->delete();
     
        return redirect()->route('articles.index')
            ->with('success','Artikel berhasil dihapus');
    }
}
