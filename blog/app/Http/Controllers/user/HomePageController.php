<?php

namespace App\Http\Controllers\user;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{

    //
    public function index()
    {
        $postList = Post::orderBy('created_at','desc')->paginate(4);
        return view('user.index', compact('postList'));
    }

    public function detail($id)
    {
        $post = Post::find($id);
        $allComments = $post->comment->all();
        $commentList = $post->comment()->orderBy('created_at','desc')->paginate(4);

        $category = $post->category->all();

        return view('user.detail', compact('post', 'category', 'commentList','allComments'));

    }

    public function comment(Request $request, $id)
    {
        $post = Post::find($id);
        $comment = new Comment();
        $comment->content = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $post->id;
        $comment->save();
        return back();
    }

    public function search(Request $request)
    {
        $key = $request->search;
        $postList = Post::where('title', 'like', '%' . $key. '%')
            ->orWhere('content', 'like', '%' . $key . '%')
            ->orderBy('created_at','desc')
            ->paginate(4);
        $postList->appends(['search' => $request->search]);

        return view('user.search', compact('postList','key'));
    }

    public function category($id)
    {
        $category = Category::find($id);

        $postList = $category->posts()->orderBy('created_at','desc')->paginate(4);
        return view('user.category', compact('category', 'postList'));
    }

    public function logout(){
        Auth::logout();
        return back();
    }

    public function jquery(){
        return view('user.jquery');
    }

    public function deleteComment($id) {
        Comment::destroy($id);
        return back();
    }
}
