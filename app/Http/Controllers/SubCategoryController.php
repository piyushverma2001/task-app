<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function getByCategory(Category $category)
    {
        return response()->json($category->subcategories()->select('id', 'name')->get());
    }
}
