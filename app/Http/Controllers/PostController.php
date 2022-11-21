<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // new posts page
    public function index()
    {
        $posts = Post::select('posts.*', 'categories.name as category_name')
            ->leftJoin('categories', 'posts.category_id', 'categories.id')
            ->when(request('table_search'), function ($query) {
                $query->where('posts.title', 'LIKE', '%' . request('table_search') . '%')
                    ->orWhere('posts.description', 'LIKE', '%' . request('table_search') . '%')
                    ->orWhere('categories.name', 'LIKE', '%' . request('table_search') . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get();
        $categories = Category::select('id', 'name')->get();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    // post details page view
    public function details($id)
    {
        $post = Post::select('posts.*', 'categories.name as category_name')
            ->leftJoin('categories', 'posts.category_id', 'categories.id')
            ->where('posts.id', $id)->first();
        return view('admin.posts.details', compact('post'));
    }

    // create posts like actually
    public function create(Request $request)
    {
        $this->validateRequest($request, null, false);
        $data = $this->getData($request);
        // store image in database and storage
        if ($request->hasFile('image')) {
            $filename = uniqid() . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $filename);
            $data['image'] = $filename;
        }
        Post::create($data);
        return redirect()->route('posts.list');
    }

    // update page view
    public function updatePage($id)
    {
        $categories = Category::select('id', 'name')->get();
        $post = Post::select('id', 'title', 'description', 'image', 'category_id')
            ->where('id', $id)->first();
        return view('admin.posts.update', compact('categories', 'post'));
    }

    // actually update post data
    public function update(Request $request, $id)
    {
        $this->validateRequest($request, $id, true);
        $data = $this->getData($request);

        // check if image exists in request and db and then store in storage and db..
        if ($request->hasFile('image')) {
            $oldFileName = Post::where('id', $id)->pluck('image')->first();
            if ($oldFileName != null) {
                Storage::delete('public/' . $oldFileName);
                // File::exists(public_path().'/'.$oldFileName);
            }
            $newFileName = uniqid() . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $newFileName);
            $data['image'] = $newFileName;
        }

        Post::where('id', $id)->update($data);
        return redirect()->route('posts.details', $id)->with(['updated' => 'Post updated.']);
    }

    // delete specific post data
    public function delete($id)
    {
        $imageName = Post::where('id', $id)->pluck('image')->first();
        if ($imageName != null) {
            Storage::delete('public/' . $imageName);
        }
        Post::where('id', $id)->delete();
        return back();
    }

    // change request to array
    private function getData($request)
    {
        return [
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id
        ];
    }

    // validate user request
    private function validateRequest($request, $id = null, $isUpdate)
    {
        $rules = [
            'title' => 'required|unique:posts,title,' . $id,
            'description' => 'required|min:10',
            'category_id' => 'required',
        ];
        $rules['image'] = $isUpdate ? 'image|mimes:png,jpg,jpeg,webp|file' : 'required|image|mimes:png,jpg,jpeg,webp|file';
        Validator::make($request->all(), $rules, [
            'category_id.required' => 'The category name field is required'
        ])->validate();
    }
}
