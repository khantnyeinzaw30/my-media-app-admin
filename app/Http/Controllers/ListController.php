<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    // admin list page
    public function index()
    {
        $admins = User::select('id', 'name', 'email', 'phone', 'address', 'gender')
            ->when(request('table_search'), function ($query) {
                $query->where('name', 'LIKE', '%' . request('table_search') . '%')
                    ->orWhere('email', 'LIKE', '%' . request('table_search') . '%')
                    ->orWhere('address', 'LIKE', '%' . request('table_search') . '%');
            })
            ->get();
        return view('admin.list.index', compact('admins'));
    }

    // delete admin account
    public function deleteAccount($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleted' => 'Selected admin account was deleted!']);
    }
}
