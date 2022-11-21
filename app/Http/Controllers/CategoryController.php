<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // posts category page
    public function index()
    {
        $categories = Category::select('id', 'name', 'description', 'created_at')
            ->when(request('table_search'), fn ($query) => $query->where('name', 'LIKE', '%' . request('table_search') . '%'))
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('admin.category.index', compact('categories'));
    }

    // actually create category
    public function create(Request $request)
    {
        $this->validateRequest($request);
        $data = $this->getDataFromRequest($request);
        Category::create($data);
        return back();
    }

    // update category page
    public function updatePage($id)
    {
        $category = Category::where('id', $id)->first();
        return view('admin.category.update', compact('category'));
    }

    // update category details
    public function update(Request $request, $id)
    {
        $this->validateRequest($request, $id);
        $data = $this->getDataFromRequest($request);
        Category::where('id', $id)->update($data);
        return redirect()->route('category.list')->with(['updated' => 'your category informations are updated.']);
    }

    // delete entire category
    public function delete($id)
    {
        Category::where('id', $id)->delete();
        return back()->with(['deleted' => 'your seleted category is deleted.']);
    }

    // change data format
    private function getDataFromRequest($request)
    {
        return [
            'name' => $request->name,
            'description' => $request->description
        ];
    }

    // validate request
    private function validateRequest($request, $id = null)
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,' . $id,
            'description' => 'required|min:10'
        ])->validate();
    }
}
