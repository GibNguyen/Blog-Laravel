<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categoryList = Category::paginate(4);
        return view('admin.category.list', compact('categoryList'));
    }

    public function add()
    {
        return view('admin.category.add');
    }

    public function postAdd(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:categories,name',

            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'This Category is exist',
            ]
        );
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect()->route('admin.category.index')->with('message', 'Register Successfull');
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function postEdit(Request $request, $id)
    {
        $category = Category::find($id);
        $request->validate(
            [
                'name' => 'required',
                Rule::unique('categories', 'name')->ignore($category->id),
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'This Category is exist',

            ]);
        $category->name = $request->name;
        $category->save();
        return redirect()->route('admin.category.index')->with('message', 'Edit Successfull');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        Category::destroy($category->id);
        return redirect()->route('admin.category.index')->with('message', 'Delete Successfull');
    }
}
