<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return $category;
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function update(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->save();

        return $category;
    }

    public function destroy(Category $category)
    {
        return $category->delete();
    }
}
