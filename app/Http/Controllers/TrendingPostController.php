<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use Illuminate\Support\Facades\DB;

// use Illuminate\Http\Request;

class TrendingPostController extends Controller
{
    // direct trending post page
    public function index()
    {
        $trendingPosts = ActionLog::select('action_logs.*', 'posts.title', 'posts.image', DB::raw('COUNT(action_logs.post_id) as post_count'))
            ->leftJoin('posts', 'action_logs.post_id', 'posts.id')
            ->groupBy('action_logs.post_id')
            ->orderBy('post_count', 'desc')
            ->get();
        return view('admin.trending_posts.index', compact('trendingPosts'));
    }
}
