<?php

namespace App\Http\Controllers\user;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    //
    public function index()
    {

    // view()->share('postList', $value);

        // $postList = Post::all();
        $postList = Post::paginate(4);
        $categoryList = Category::all();
        return view('user.index', compact('postList', 'categoryList'));
    }

    public function detail($id)
    {
        $post = Post::find($id);
        $commentList = $post->comment->all();
        $categoryList = Category::all();

        $category = $post->category->all();

        return view('user.detail', compact('post', 'category', 'categoryList', 'commentList'));

    }

    public function comment(Request $request, $id)
    {
        $categoryList = Category::all();

        $post = Post::find($id);
        $commentList = $post->comment->all();

        $category = $post->category->all();
        $comment = new Comment();

        $comment->content = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $post->id;
        $comment->save();
        // return view('user.detail', compact('post', 'category', 'categoryList', 'commentList'));
        return back();
    }

    public function search(Request $request)
    {
        $key = $request->search;
        $postList = Post::where('title', 'like', '%' . $key. '%')
            ->orWhere('content', 'like', '%' . $key . '%')
            ->paginate(4);
        $postList->appends(['search' => $request->search]);

        $categoryList = Category::all();
        return view('user.search', compact('postList', 'categoryList','key'));
    }

    public function category($id)
    {
        $category = Category::find($id);

        $postList = $category->posts()->paginate(4);
        $categoryList = Category::all();
        return view('user.category', compact('category', 'postList', 'categoryList'));
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
