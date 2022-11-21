<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ActionLog;
use Illuminate\Http\Request;

class ActionLogController extends Controller
{
    // increase view count and return post view count
    public function actionLog(Request $request)
    {
        ActionLog::create([
            'user_id' => $request->userId,
            'post_id' => $request->postId
        ]);
        $viewCount = count(ActionLog::where('post_id', $request->postId)->get());
        return response()->json(['viewCount' => $viewCount]);
    }
}
