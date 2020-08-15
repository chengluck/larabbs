<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Link;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\User;

class CategoriesController extends Controller
{
    public function show(Category $category, Request $request, Topic $topic, User $user, Link $link)
    {
        // 读取分类 ID 关联的话题, 并按每 20 条分页
        $topics = $topic->withOrder($request->order)
                        ->with(['user', 'category'])
                        ->where('category_id', $category->id)
                        ->paginate(20);
        // 活跃用户列表
        $active_users = $user->getActiveUsers();
        $links = $link->getAllCached();
        return view('topics.index', compact('topics', 'category', 'active_users', 'links'));
    }
}
