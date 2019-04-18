<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function index()
    {
        return Post::all();
    }

  
    public function create()
    {
        
    }

   
    public function store(Request $request)
    {
        return Post::create($request->all());
    }

   
    public function show($id)
    {
        return Post::find($id);
    }

   
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        return $post;
    }

    
    public function destroy($id)
    {
        Post::find($id)->delete();

        return 204;
    }
}
