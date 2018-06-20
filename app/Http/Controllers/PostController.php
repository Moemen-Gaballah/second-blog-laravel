<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use Session;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct() {
        $this->middleware('admin', ['only' => ['edit', 'showposts']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('status', '=', 1)->get();
        $categories = Category::all();
        return view('index', compact(['posts','categories']));
    }

    public function showposts()
    {
        $posts = Post::all();
        $categories = Category::all();
        return view('post.index', compact(['posts','categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));
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

//        dd($request->all());
        $this->validate($request, array(
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
            'category_id' => 'required|integer',
            'status' => 'required|in:0,1',
            'image' => 'sometimes|image'
        ));

        // Store in the database
        $post = new Post;

        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->user_id = Auth::user()->id;
        $post->status = $request->status;

        // Save our Image
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('/img');
            $post->image = $filename;
            $image->move($location, $filename);
        }

        $post->tags = $request->tags;
        $post->save();

        Session::flash('success', 'The post was successfully save!');
        return redirect()->route('post');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $comments = Comment::where('post_id', '=' ,$post->id)->where('status', '=', 1)->get();
//        dd($comments);
        $views =$post->views;
        $post->views = $views + 1;
        $post->save();
        return view('post.show')->withPost($post)->withComments($comments);
    }

//    public function findByTitle($title)
//    {
//        $post = Post::where('title', $title)->firstOrFail();
//
//        // return view
//        return view('post.show')->withPost($post);
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if ($request->input('title') == $post->title) {
            $this->validate($request, array(
                'body' => 'required',
                'category_id' => 'required|integer',
                'status' => 'required|in:0,1',
                'image' => 'sometimes|image'
            ));
        }else {
                $this->validate($request, array(
                    'title' => 'required|max:255|unique:posts',
                    'body' => 'required',
                    'category_id' => 'required|integer',
                    'status' => 'required|in:0,1',
                    'image' => 'sometimes|image'
                ));
            }
            // save the data to the database
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->category_id = $request->input('category_id');
            $post->status = $request->input('status');
            $post->tags = $request->input('tags');

            if ($request->hasFile('image')) {
                // Add the new Photo
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('/img');

                $image->move($location, $filename);

                // Delete Old Photo
                $oldPhotoName = $post->image;

                // update The database
                $post->image = $filename;

                // Delete the old Photo
               File::delete('img/'.$oldPhotoName);
            }

            $post->save();

            // Set flash data with success message
            Session::flash('success','This post was successfully saved.');

            // redirect with flash data to posts.show
            return redirect()->route('post.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
