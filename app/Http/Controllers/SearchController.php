<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Gets the query string from our form submission
        $query = $request->input('search');
        // Returns an array of articles that have the query string located somewhere within
        // our articles titles. Paginates them so we can break up lots of search results.
        $posts = \DB::table('posts')->where('title', 'LIKE', '%' . $query . '%')->paginate(1);

        // returns a view and passes the view the list of articles and the original query.
        return view('post.search', compact('posts', 'query'));
    }
}
