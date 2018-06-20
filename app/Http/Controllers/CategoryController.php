<?php

namespace App\Http\Controllers;

use App\Category;
use Session;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::All();

        return view('categories.index')->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Save a new Category and then redirect back to index
        $this->validate($request, array(
            'name' => 'required|unique:categories|max:255',
            'description' => 'required',
            'status' => 'required|in:0,1'
        ));

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->user_id = Auth::user()->id;
        $category->save();

        Session::flash('success', 'New Category has been created');
        return redirect('/');
//        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $posts = Post::where('category_id', '=', $category->id)->where('status', '=', 1)->get();
//        dd($category);
//        dd($posts);
        return view('categories.show')->withCategory($category)->withPosts($posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit')->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if ($request->input('name') == $category->name){
            $this->validate($request, array(
                'description' => 'required',
                'status' => 'required|in:0,1'
            ));
        }else{
            $this->validate($request, array(
                'name' => 'required|unique:categories|max:255',
                'description' => 'required',
                'status' => 'required|in:0,1'
            ));
        }
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->user_id = Auth::user()->id;
        $category->save();

        Session::flash('success', 'This post was successfully saved.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        Session::flash('success', 'The Category was successfully deleted');
        return redirect()->route('category.index');
    }
}
