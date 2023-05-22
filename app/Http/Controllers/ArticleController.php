<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Products;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() # SHOW
    {
        $articles = Articles::paginate(5);
    
        return view('articles.index',compact('articles'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $input = $request->all();
  
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

        return view('articles.show',['article' => $article]);
    }

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
    public function update(Request $request, Articles $articles) # UPDATING PROCESS
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required'
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
          
        $articles->update($input);
    
        return redirect()->route('articles.index')
            ->with('success','Articles updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articles $article)
    {
        $article->delete();
     
        return redirect()->route('articles.index')
            ->with('success','article deleted successfully');
    }
}
