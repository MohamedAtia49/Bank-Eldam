<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $records = Category::all();
        return view('Categories.index',compact('records'));
    }


    public function create()
    {
        return view('Categories.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);
        Category::create([
            'name' => $request->name,
        ]);
        return redirect('admin/categories');
    }


    public function edit($id)
    {
        $record = Category::where('id', $id)->first();
        return view('categories.edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);
        $record = Category::where('id', $id)->update([
            'name' => $request->name,
        ]);
        return redirect('admin/categories');
    }

    public function destroy($id)
    {
        $record = Category::where('id', $id)->first();
        $record->delete();
        $record->posts()->delete();
        return redirect('admin/categories');
    }
}
