<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function index()
    {

        // $postList = Post::all();
        $postList = Post::paginate(4);
        return view('admin.post.list', compact('postList'));
    }

    public function add()
    {
        $categoryList = Category::all();
        return view('admin.post.add', compact('categoryList'));
    }

    public function postAdd(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'content' => 'required',
                'category' => 'required',
                'category.*' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

            ],
            [
                'title.required' => 'Title is required',
                'content.required' => 'Content is required',
                'category.required' => 'You must choose at least one',
                'image.required' => 'Image is required',

            ]
        );
        // dd($request);
        $post = new Post();
        $post->title = $request->title;

        $idAuthor = Auth::id();
        $user = User::find($idAuthor);
        $post->author = $user->name;

        $post->content = $request->content;

        if ($request->file('image')) {
            $image = $request->file('image');
            $getImage = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('upload/image');
            $image->move($destinationPath, $getImage);

            $post->image = $getImage;
        }

        $post->save();
        $post->category()->sync($request->category, []);

        return redirect()->route('admin.post.index')->with('message', 'Register Successfull');
    }
    public function edit($id)
    {
        $post = Post::find($id);

        $categoryList = Category::all();
        return view('admin.post.edit', compact('post', 'categoryList'));
    }

    public function postEdit(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required',
                'content' => 'required',
                'category' => 'required',
                'category.*' => 'required',
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',

            ],
            [
                'title.required' => 'Title is required',
                'content.required' => 'Content is required',
                'category.required' => 'You must choose at least one',
                'image.required' => 'Image is required',

            ]
        );
        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;

        // $data = [
        //     $post->title => $request->title,
        //     $post->content => $request->content;
        // ];

        if ($request->file('image')) {
            $image = $request->file('image');
            $getImage = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('upload/image');
            $image->move($destinationPath, $getImage);

            $post->image = $getImage;
        }
        // dd($request->input('category'));
        // dd($request->category,[]);
        $post->save();
        $post->category()->sync($request->category);
        // $post->category()->sync($request->input('category', []));

        return redirect()->route('admin.post.index')->with('message', 'Update Successfull');
    }

    public function delete($id)
    {
        $post = Post::find($id);
        Post::destroy($post->id);
        return redirect()->route('admin.post.index')->with('message', 'Delete Successfull');
    }

    public function detail($id)
    {
        $post = Post::find($id);
        // dd($post->category->all());
        return view('admin.post.detail', compact('post'));

    }
}
