<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Auth;
use Session;
use Illuminate\Http\Request;
use Zttp\Zttp;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();

        return view('comment.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());

              if(Auth::check()){
                $this->validate($request, array(
                    'body' => 'required',
                    'post_id' => 'required|integer',
//                    'g-recaptcha-response' => 'recaptcha'
                ));

                  $response = Zttp::asFormParams()->post('https://www.google.com/recaptcha/api/siteverify', [
                      'secret' => config('services.recaptcha.secret'),
                      'response' => $request->input('g-recaptcha-response'),
                      'remoteip' => $_SERVER['REMOTE_ADDR']
                  ]);

                  if (! $response->json()['success']) {
                      Session::flash('error', 'Recaptcha failed!');
                      return redirect()->back();
//                      throw new \Exception('Recaptcha failed');
                  }
//                  dd($response->json());
              }else{
                  $this->validate($request, array(
                    'user_id' => 'required|max:255',
                    'email' => 'required|email',
                    'body' => 'required',
                    'post_id' => 'required|integer',
//                    'g-recaptcha-response' => 'recaptcha'

                  ));
                  $response = Zttp::asFormParams()->post('https://www.google.com/recaptcha/api/siteverify', [
                      'secret' => config('services.recaptcha.secret'),
                      'response' => $request->input('g-recaptcha-response'),
                      'remoteip' => $_SERVER['REMOTE_ADDR']
                  ]);

                  if (! $response->json()['success']) {
                      Session::flash('error', 'Recaptcha failed!');
                      return redirect()->back();
//                      throw new \Exception('Recaptcha failed');
                  }
//                  dd($response->json());

                }


        // Store in the database
        $comment = new Comment;

       if(Auth::check()){ $comment->user_id =  Auth::user()->name;
           $comment->email = Auth::user()->email;
       } else {
           $comment->user_id = $request->user_id;
           $comment->email = $request->email;
        }

        $comment->body = $request->body;
        $comment->post_id = $request->post_id;
//        $post->image = $request->image;
        $comment->status = 0;

        $comment->save();

        Session::flash('success', 'The post was successfully save!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        $post = Post::where('id', '=', $comment->post_id)->first();
//            dd($comment->post_id);
        return view('comment.edit', compact('comment', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $comment = Comment::find($id);
        $this->validate($request, array(
            'body' => 'required',
            'status' => 'required|in:0,1'
        ));
        $comment->body = $request->body;
        $comment->status = $request->status;

        $comment->save();

        Session::flash('success', 'The Comment was successfully Save!');
        return redirect()->route('comment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
