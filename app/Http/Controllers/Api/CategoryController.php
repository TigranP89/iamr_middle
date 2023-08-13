<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Controllers\BaseController;

class CategoryController extends BaseController
{
  /**
   * CategoryController constructor.
   */
  public function __construct()
  {
    parent::__construct();
  }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    try {
      $category = Category::orderBy('order_id', 'asc')
                            ->get()
                            ->toArray();

      return response()->json([
        'category' => $category
      ]);
    } catch (\Exception $e) {
      return response()->json([
        "error" => $e->getMessage(),
        "result" => null
      ]);
    }
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreCategoryRequest $request)
  {
      //
  }

  /**
   * Display the specified resource.
   */
  public function show(Category $category)
  {
    try {
      $category = Category::with('posts')
        ->find($category->id);

      return response()->json([
        "category" => $category
      ]);
    }  catch (\Exception $e) {
      return response()->json([
        "error" => $e->getMessage(),
        "result" => null
      ]);
    }
  }

  /**
   * @param Category $category
   * @return \Illuminate\Http\JsonResponse
   */
  public function showPostWithCategory(Category $category)
  {
    try {
      $category = Category::with('posts')
//        ->where('id', $category->id)
        ->find($category->id);

      $posts = $category->posts->toArray();

      return response()->json([
        "posts" => $posts
      ]);
    }  catch (\Exception $e) {
      return response()->json([
        "error" => $e->getMessage(),
        "result" => null
      ]);
    }
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Category $category)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateCategoryRequest $request, Category $category)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Category $category)
  {
      //
  }
}
