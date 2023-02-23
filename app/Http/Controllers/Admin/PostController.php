<?php

namespace App\Http\Controllers\Admin;


use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $records = Post::with('category')->paginate(20);
        return view('posts.index',compact('records'));
    }


    public function create()
    {
        return view('posts.create')->with('categories',Category::all());
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => "required|max:255|min:3",
            "image" => "required|image|mimes:png,jpg,svg,jpeg",
            'content' => 'required',
            'category_id'=> 'required|exists:categories,id',
        ]);

       //upload image
       $image =$request->file('image');
       $path = $image->storeAs(
           'posts',
           $image->hashName(),
           'public'
       );

        Post::create([
            "title" => $request->title ,
            "category_id" => $request->category_id ,
            "content" => $request->content ,
            "image" => $path ,
        ]);
        return redirect('admin/posts');
    }


    public function edit($id)
    {
        $record = Post::with('category')->find($id);
        $categories = Category::all();
        return view('posts.edit', compact('record','categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "title" => "required|max:255|min:3",
            "image" => "required|image|mimes:png,jpg,svg,jpeg",
            'content' => 'required',
            'category_id'=> 'required|exists:categories,id',
        ]);

        //upload image
        $image =$request->file('image');
        $path = $image->storeAs(
            'posts',
            $image->hashName(),
            'public'
        );

        $record = Post::find($id)->update([
            "title" => $request->title ,
            "category_id" => $request->category_id ,
            "content" => $request->content ,
            "image" => $path ,
        ]);
        return redirect('admin/posts');
    }

    public function destroy($id)
    {
        $record = Post::where('id', $id)->first();
        Storage::disk('public')->delete($record->image);
        $record->delete();

        return redirect('admin/posts');
    }
}
