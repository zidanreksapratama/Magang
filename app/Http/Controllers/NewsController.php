<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index()
    {
        $news = DB::table('news')
            ->leftJoin('companies', 'news.created_by_tenant_id', '=', 'companies.id')
            ->select(
                'news.id',
                'news.title',
                'news.content',
                'news.image',
                'news.created_by_company_id',
                'news.created_by_tenant_id',
                'companies.name as tenant_name', 
                'news.created_at',
                'news.updated_at'
            )
            ->get();

        return response()->json([
            'success' => true,
            'data' => $news
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string',
        ]);

        $tenant = $request->user(); // Authenticated tenant

        $news = News::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->image,
            'created_by_tenant_id' => $tenant->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'News created successfully',
            'data' => $news,
        ]);
    }
}
