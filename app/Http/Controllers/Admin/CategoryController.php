<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Http\Controllers\BaseController;
use App\Models\Order;

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
      $categories = Category::with('order')
      ->orderBy('order_id', 'asc')->get();

      return view('pages.admin.categories.index',compact('categories'))
          ->with('i');
    } catch (\Exception $e){
      return $e->getMessage();
    }
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    try {
      $orders = Order::all();

      return view('pages.admin.categories.create', compact('orders'));
    } catch (\Exception $e){
      return $e->getMessage();
    }
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreCategoryRequest $request)
  {
    try {
      $input = $request->all();

      $category = new Category;
      $category->title = $input['title'];
      $category->status = isset($input['status']) ? 1 : 0;
      $category->order_id = $input['order_id'];
      $category->save();

      return  redirect('admin/categories');
    } catch (\Exception $e){
      return $e->getMessage();
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Category $category)
  {
    try {
      $orders = Order::all();
      $selectCategory = Category::where('id', $category->id)
          ->first();

      return  view('pages.admin.categories.show', compact('selectCategory', 'orders'));
    } catch (\Exception $e){
      return $e->getMessage();
    }
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Category $category)
  {
    try {
      $orders = Order::all();
      $selectCategory = Category::where('id', $category->id)->first();

      return  view('pages.admin.categories.edit', compact('selectCategory', 'orders'));
    } catch (\Exception $e){
      return $e->getMessage();
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateCategoryRequest $request, Category $category)
  {
    try {
      $input = $request->all();

      $category = Category::find($category->id);
      $category->title = $input['title'];
      $category->status = isset($input['status']) ? 1 : 0;
      $category->order_id = $input['order_id'];
      $category->update();

      return  redirect('admin/categories');
    } catch (\Exception $e){
      return $e->getMessage();
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Category $category)
  {
    try {
      Category::destroy($category->id);

      return  redirect('admin/categories');
    } catch (\Exception $e){
      return $e->getMessage();
    }
  }
}
